<?php
session_start();
require_once __DIR__ . '/../Model/db.php';

$identifier = $_POST['id'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($identifier) || empty($password)) {
    echo "<h2>Invalid credentials</h2>";
    exit;
}

$user = checkLogin($identifier, $password);

if ($user !== false) {
    // set session and redirect by role
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['userid'] = $user['id'];

    switch ($user['role']) {
        case 'admin':
            header('Location: ../View/AdminDashboard.php');
            exit;
        case 'employer':
            header('Location: ../View/EmployerDashboard.php');
            exit;
        case 'jobseeker':
        default:
            header('Location: ../View/JobseekerDashboard.php');
            exit;
    }
} else {
    echo "<h2>Invalid username/email or password</h2>";
    exit;
}
?>