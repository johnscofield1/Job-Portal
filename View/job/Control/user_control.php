<?php
session_start();
require_once __DIR__ . '/../Model/db.php';

if (!isset($_SESSION['userid'])) { header('Location: ../View/Login.php'); exit; }

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'change_password' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current'] ?? ''; $new = $_POST['new'] ?? '';
    $conn = createCon();
    $stmt = mysqli_prepare($conn, 'SELECT password FROM users WHERE id = ? LIMIT 1');
    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['userid']);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($res)) {
        if (password_verify($current, $row['password'])) {
            $hash = password_hash($new, PASSWORD_BCRYPT);
            $upd = mysqli_prepare($conn, 'UPDATE users SET password = ? WHERE id = ? LIMIT 1');
            mysqli_stmt_bind_param($upd, 'si', $hash, $_SESSION['userid']);
            mysqli_stmt_execute($upd);
            mysqli_stmt_close($upd);
            echo 'Password changed';
        } else echo 'Current password incorrect';
    }
    mysqli_stmt_close($stmt); mysqli_close($conn); exit;
}

echo 'User action scaffold';
?>