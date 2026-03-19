<?php
session_start();
require_once 'config/db.php';
require_once 'includes/activity-logger.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $contact = trim($_POST['contact']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    // Validation
    $errors = [];
    
    // Name validation
    if (empty($firstName) || empty($lastName)) {
        $errors[] = "First name and last name are required";
    }
    
    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address";
    }
    
    // Contact validation
    if (!preg_match('/^\d{10}$/', $contact)) {
        $errors[] = "Contact number must be 10 digits";
    }
    
    // Password validation
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }
    
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    
    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $errors[] = "Email already registered";
    }
    
    if (!empty($errors)) {
        $_SESSION['reg_errors'] = $errors;
        $_SESSION['reg_form_data'] = $_POST;
        header("Location: register.php");
        exit();
    }

    // Create user immediately (no OTP/email verification)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $default_profile_pic = 'images/profiles/demoUser.jpg';

    $stmt = $conn->prepare(
        "INSERT INTO users (first_name, last_name, email, contact, password, profile_pic, status) 
         VALUES (?, ?, ?, ?, ?, ?, 'verified')"
    );
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $contact, $hashedPassword, $default_profile_pic);

    if ($stmt->execute()) {
        $user_id = $stmt->insert_id;

        // Set session and cookie
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_first_name'] = $firstName;
        $_SESSION['user_last_name'] = $lastName;
        $_SESSION['user_name'] = $firstName . ' ' . $lastName;
        $_SESSION['user_role'] = 'customer';
        $_SESSION['logged_in'] = true;

        // Set cookie for 30 days
        $cookie_value = base64_encode($user_id . '|' . $email);
        setcookie('user_auth', $cookie_value, time() + (30 * 24 * 60 * 60), '/');

        // Log registration activity
        logActivity($conn, $user_id, 'registration', "$firstName $lastName registered with email: $email");

        header("Location: index.php");
        exit();
    } else {
        $_SESSION['reg_errors'] = ["Registration failed. Please try again."];
        $_SESSION['reg_form_data'] = $_POST;
        header("Location: register.php");
        exit();
    }
}

// If accessed directly, redirect to register page
header("Location: register.php");
exit();
