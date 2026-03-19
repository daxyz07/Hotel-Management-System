<?php
session_start();
// Start output buffering to prevent stray output (BOM/whitespace) from breaking JSON responses
ob_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/activity-logger.php';

// Debug logging helper (temporary) - writes requests and responses to storage/profile_debug.log
$debug_log_file = __DIR__ . '/../storage/profile_debug.log';
function debug_profile_log($msg) {
    global $debug_log_file;
    $entry = '[' . date('Y-m-d H:i:s') . '] ' . $msg . PHP_EOL;
    file_put_contents($debug_log_file, $entry, FILE_APPEND);
}

function respond($arr) {
    // Clear any stray output that could break JSON responses
    if (ob_get_length()) {
        ob_clean();
    }
    // Log response (mask sensitive values if present)
    debug_profile_log('Response: ' . json_encode($arr));
    echo json_encode($arr);
    exit();
} 

// Admin authorization check - require admin login but allow any admin role
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    debug_profile_log('Unauthorized access attempt. Session info: admin_id=' . ($_SESSION['admin_id'] ?? 'none') . ', admin_role=' . ($_SESSION['admin_role'] ?? 'none'));
    respond(['success' => false, 'message' => 'Unauthorized access. Admin login required.']);
} 

$action = $_POST['action'] ?? $_GET['action'] ?? '';
$admin_id = $_SESSION['admin_id'] ?? null;
// Ensure admin_id exists and is a valid positive integer
if (empty($admin_id) || ((int)$admin_id) <= 0) {
    debug_profile_log('Invalid or missing admin_id in session. Session info: admin_id=' . ($admin_id ?? 'none') . ', admin_role=' . ($_SESSION['admin_role'] ?? 'none'));
    respond(['success' => false, 'message' => 'Invalid session. Please login again.']);
}

$filtered_post = $_POST;
foreach ($filtered_post as $k => $v) {
    if (stripos($k, 'password') !== false) $filtered_post[$k] = '***';
}
debug_profile_log('Incoming request: action=' . $action . ' admin_id=' . ($admin_id ?? 'none') . ' POST=' . json_encode($filtered_post));

if ($action === 'update_profile') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $address = trim($_POST['address'] ?? '');
    
    if (empty($first_name) || empty($last_name) || empty($email)) {
        $errors = [];
        if (empty($first_name)) $errors[] = 'first name';
        if (empty($last_name)) $errors[] = 'last name';
        if (empty($email)) $errors[] = 'email';
        respond(['success' => false, 'message' => 'Missing required fields: ' . implode(', ', $errors)]);
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        respond(['success' => false, 'message' => 'Invalid email format']);
    }
    
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $stmt->bind_param("si", $email, $admin_id);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        respond(['success' => false, 'message' => 'Email already exists']);
    }
    
    $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, contact = ?, address = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $contact, $address, $admin_id);
    
    if ($stmt->execute()) {
        $_SESSION['admin_name'] = $first_name . ' ' . $last_name;
        logActivity($conn, $admin_id, 'update', 'updated profile information');
        respond(['success' => true, 'message' => 'Profile updated successfully']);
    } else {
        debug_profile_log('MySQL update profile error: ' . $stmt->error);
        respond(['success' => false, 'message' => 'Failed to update profile']);
    }
}

if ($action === 'change_password') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    
    if (!$current_password || !$new_password) {
        respond(['success' => false, 'message' => 'All fields are required']);
    }
    
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    
    if (!password_verify($current_password, $result['password'])) {
        respond(['success' => false, 'message' => 'Current password is incorrect']);
    }
    
    $hashed = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $hashed, $admin_id);
    
    if ($stmt->execute()) {
        logActivity($conn, $admin_id, 'update', 'changed account password');
        respond(['success' => true, 'message' => 'Password changed successfully']);
    } else {
        debug_profile_log('MySQL change password error: ' . $stmt->error);
        respond(['success' => false, 'message' => 'Failed to change password']);
    }
}

if ($action === 'upload_profile_image') {
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        respond(['success' => false, 'message' => 'No image uploaded']);
    }
    
    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['image']['type'], $allowed_types)) {
        respond(['success' => false, 'message' => 'Invalid image type. Only JPG, PNG, and GIF allowed']);
    }
    
    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        respond(['success' => false, 'message' => 'Image size too large. Maximum 5MB allowed']);
    }
    
    $upload_dir = __DIR__ . '/../images/profiles/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    $stmt = $conn->prepare("SELECT profile_pic FROM users WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $old_image = $stmt->get_result()->fetch_assoc()['profile_pic'];
    
    if ($old_image && file_exists(__DIR__ . '/../' . $old_image)) {
        unlink(__DIR__ . '/../' . $old_image);
    }
    
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $filename = uniqid('profile_') . '.' . $ext;
    $filepath = $upload_dir . $filename;
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $filepath)) {
        $image_path = 'images/profiles/' . $filename;
        
        $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
        $stmt->bind_param("si", $image_path, $admin_id);
        
        if ($stmt->execute()) {
            respond(['success' => true, 'message' => 'Profile image updated successfully', 'image_path' => $image_path]);
        } else {
            debug_profile_log('MySQL update profile image error: ' . $stmt->error);
            respond(['success' => false, 'message' => 'Failed to update database']);
        }
    } else {
        respond(['success' => false, 'message' => 'Failed to upload image']);
    }
}

respond(['success' => false, 'message' => 'Invalid action']);
?>
