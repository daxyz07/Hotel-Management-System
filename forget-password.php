<?php
// Add this code near the beginning of forget-password.php
if (isset($_SESSION['pwd-error'])) {
    $error = $_SESSION['pwd-error'];
    unset($_SESSION['pwd-error']);
}

session_start();
require_once 'config/db.php';

// Function to generate secure random token
function generateToken($length = 64)
{
    return bin2hex(random_bytes($length / 2));
}

// Function to generate and store a reset token (no email sending)
function generateAndStoreResetToken($conn, $email)
{
    $token = generateToken();
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // First, invalidate all previous tokens for this email
    $stmt = $conn->prepare("UPDATE password_resets SET is_expired = 1 WHERE email = ? AND is_expired = 0");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Store new token (otp field left empty)
    $stmt = $conn->prepare("INSERT INTO password_resets (email, otp, token, expiry) VALUES (?, '', ?, ?)");
    $stmt->bind_param("sss", $email, $token, $expiry);

    if ($stmt->execute()) {
        return ['token' => $token, 'expiry' => $expiry];
    }
    return false;
}

$error = '';
$success = '';
$step = 1;
$email = '';
$reset_link = '';

// Restore email from session if available
if (isset($_SESSION['pwd-reset-email'])) {
    $email = $_SESSION['pwd-reset-email'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        // Check if user exists
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ? AND status = 'verified'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $res = generateAndStoreResetToken($conn, $email);
            if ($res) {
                $success = "A password reset link has been generated. Use the link below to reset your password.";
                $step = 2;
                $_SESSION['pwd-reset-email'] = $email;
                $reset_link = 'reset-password.php?token=' . urlencode($res['token']);
            } else {
                $error = "Error generating reset token. Please try again.";
            }
        } else {
            $error = "Email address not found!";
        }
    }
}

// Not using OTP/verification code in password reset flow
$resendTimeRemaining = null;
$otpExpiryRemaining = null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Annapurna Hotel and Restaurant</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="assets/css/forget-password.css">
</head>

<body>
    <div class="pwd-container">
        <div class="pwd-form-container">
            <div class="pwd-logo">
                <img src="logo.png" alt="Annapurna Hotel Logo">
            </div>
            <h1>Reset Password</h1>

            <?php if ($error): ?>
                <div class="pwd-alert pwd-alert-error">
                    <ion-icon name="alert-circle"></ion-icon>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="pwd-alert pwd-alert-success">
                    <ion-icon name="checkmark-circle"></ion-icon>
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <div id="pwd-step1Form" <?php echo $step == 2 ? 'style="display:none;"' : ''; ?>>
                <form id="pwd-emailForm" method="POST" action="">
                    <div class="pwd-form-group">
                        <label for="pwd-email">
                            <ion-icon name="mail"></ion-icon>
                            Email Address
                        </label>
                        <input type="email" id="pwd-email" name="email"
                            value="<?php echo htmlspecialchars($email); ?>"
                            required placeholder="Enter your email address">
                    </div>
                    <div class="pwd-button-group">
                        <button type="submit" class="pwd-btn pwd-btn-primary">
                            <ion-icon name="mail-open"></ion-icon>
                            Send Reset Link
                        </button>
                        <a href="login.php" class="pwd-text-link">
                            <ion-icon name="arrow-back"></ion-icon>
                            Back to Login
                        </a>
                    </div>
                </form>
            </div>

            <!-- Step 2 form with modified email display and timer -->
            <div id="pwd-step2Form" <?php echo $step == 1 ? 'style="display:none;"' : ''; ?>>
                <div class="pwd-email-display">
                    <span>Your entered email is: <?php echo htmlspecialchars($email); ?></span>
                    <a href="javascript:void(0)" class="pwd-text-link" onclick="changeEmail()">Change</a>
                </div>

                <?php if (!empty($reset_link)): ?>
                <div class="pwd-reset-container" style="margin-top:20px;">
                    <p><strong>Reset link (copy or click to open):</strong></p>
                    <div style="word-break:break-all; background:#f5f5f5; padding:12px; border-radius:6px;">
                        <a href="<?php echo htmlspecialchars($reset_link); ?>"><?php echo htmlspecialchars($reset_link); ?></a>
                    </div>
                    <p style="margin-top:10px; color:#666;">This link will expire in 1 hour.</p>
                </div>
                <?php else: ?>
                <div class="pwd-info" style="margin-top:20px;">
                    <p>After submitting your email, a reset link will be generated here for you to use.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


</body>

</html>