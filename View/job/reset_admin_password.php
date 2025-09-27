<?php
// job/reset_admin_password.php - TEMPORARY: resets admin password to 'admin123'
require_once __DIR__ . '/Model/db.php';

// WARNING: temporary script. Remove after use.

$conn = createCon();
$newpass = 'admin123';
$hash = password_hash($newpass, PASSWORD_BCRYPT);

// update the admin row by username 'admin' (or email)
$sql = "UPDATE users SET password = ? WHERE username = 'admin' OR email = 'admin@example.com' LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $hash);
$res = mysqli_stmt_execute($stmt);
if ($res) {
    echo "<p style='color:green;'>Admin password reset to 'admin123'. Now try to login.</p>";
} else {
    echo "<p style='color:red;'>Failed to reset password. Error: " . mysqli_error($conn) . "</p>";
}
mysqli_stmt_close($stmt);
mysqli_close($conn);

echo "<p>Important: delete reset_admin_password.php when done (security risk if left).</p>";
?>
