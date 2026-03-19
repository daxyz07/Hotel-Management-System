<?php
session_start();
// Verification via OTP has been disabled. Redirecting to registration page.
header("Location: register.php");
exit();// Verification disabled; no further server-side verification logic is required.

// Verification disabled; this page intentionally removed UI and logic. Refer users to register or login.
exit();


