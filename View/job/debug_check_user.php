<?php
// job/debug_check_user.php - temporary debug (delete after use)
require_once __DIR__ . '/Model/db.php';

$email = $_GET['email'] ?? '';
$password = $_GET['password'] ?? '';

if (!$email) {
    echo "<p>Usage: debug_check_user.php?email=you@example.com&password=thepass</p>";
    exit;
}

$conn = createCon();

$sql = "SELECT id, username, email, password, role FROM users WHERE email = ? OR username = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $email, $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$row = mysqli_fetch_assoc($result)) {
    echo "<p style='color:red;'>User not found for '{$email}'</p>";
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit;
}

echo "<p>Found user: id={$row['id']}, username={$row['username']}, email={$row['email']}, role={$row['role']}</p>";
echo "<p>Stored password hash: <code>" . htmlspecialchars($row['password']) . "</code></p>";

$ok = password_verify($password, $row['password']);
if ($ok) {
    echo "<p style='color:green;'>password_verify('{$password}', stored_hash) => TRUE</p>";
} else {
    echo "<p style='color:red;'>password_verify('{$password}', stored_hash) => FALSE</p>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
