<?php
// job/debug_check.php - temporary debug script

require_once __DIR__ . '/Model/db.php';

echo "<h2>Debug: DB connection & admin check</h2>";

// 1) Test connection
$conn = createCon();
if (!$conn) {
    echo "<p style='color:red;'>Cannot connect to DB.</p>";
    exit;
} else {
    echo "<p style='color:green;'>Connected to DB successfully.</p>";
}

// 2) Does users table exist and has admin row?
$res = mysqli_query($conn, "SELECT COUNT(*) AS c FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = 'users'");
$row = mysqli_fetch_assoc($res);
if ($row['c'] == 0) {
    echo "<p style='color:red;'>Table <b>users</b> does NOT exist in the current DB. Import jobportal_schema.sql.</p>";
    mysqli_close($conn);
    exit;
} else {
    echo "<p style='color:green;'>Table <b>users</b> found.</p>";
}

$q = mysqli_query($conn, "SELECT id, username, email, password, role FROM users WHERE username = 'admin' OR email = 'admin@example.com' LIMIT 1");
if (!$q || mysqli_num_rows($q) == 0) {
    echo "<p style='color:red;'>Admin row not found (username=admin). Did you import jobportal_schema.sql?</p>";
    mysqli_close($conn);
    exit;
}
$admin = mysqli_fetch_assoc($q);
echo "<p>Found admin row: id={$admin['id']}, username={$admin['username']}, email={$admin['email']}, role={$admin['role']}</p>";
// **Do not** echo the hash in production, but for debug we will show it
echo "<p>Password hash (stored): <code>" . htmlspecialchars($admin['password']) . "</code></p>";

// 3) Verify the password "admin123"
$test = 'admin123';
$ok = password_verify($test, $admin['password']);
if ($ok) {
    echo "<p style='color:green;'>password_verify('admin123', stored_hash) => <b>TRUE</b>. Login should work with admin/admin123.</p>";
} else {
    echo "<p style='color:red;'>password_verify('admin123', stored_hash) => <b>FALSE</b>. Stored hash does NOT match admin123.</p>";
    echo "<p>If false, you can (temporarily) run the reset script to set admin password to admin123.</p>";
}

mysqli_close($conn);
?>
