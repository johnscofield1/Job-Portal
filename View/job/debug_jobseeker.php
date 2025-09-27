<?php
// job/debug_jobseeker.php  — temporary diagnostic script
require_once __DIR__ . '/Model/db.php';

echo "<h2>Debug: users table & jobseeker checks</h2>";

$conn = createCon();
if (!$conn) {
    echo "<p style='color:red;'>DB connection failed.</p>";
    exit;
}

echo "<p style='color:green;'>Connected to DB.</p>";

// 1) Confirm users table exists
$res = mysqli_query($conn, "SELECT COUNT(*) AS c FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = 'users'");
$r = mysqli_fetch_assoc($res);
if ($r['c'] == 0) {
    echo "<p style='color:red;'>Table 'users' NOT found in DB.</p>";
    mysqli_close($conn);
    exit;
}
echo "<p>Table <b>users</b> present.</p>";

// 2) Show last 10 users
$q = mysqli_query($conn, "SELECT id, username, email, role, password FROM users ORDER BY id DESC LIMIT 10");
echo "<h3>Last 10 users</h3>";
echo "<table border='1' cellpadding='6'><tr><th>id</th><th>username</th><th>email</th><th>role</th><th>password_hash</th></tr>";
while ($row = mysqli_fetch_assoc($q)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
    echo "<td><code>" . htmlspecialchars($row['password']) . "</code></td>";
    echo "</tr>";
}
echo "</table>";

// 3) Optional: test password verify for a specific email (use GET params ?email=you@example.com&pass=thepass)
if (!empty($_GET['email']) && isset($_GET['pass'])) {
    $email = $_GET['email'];
    $pass = $_GET['pass'];
    $stmt = mysqli_prepare($conn, "SELECT password, username, role FROM users WHERE email = ? OR username = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 'ss', $email, $email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($res)) {
        $ok = password_verify($pass, $row['password']);
        echo "<h3>Password test for " . htmlspecialchars($email) . "</h3>";
        echo "<p>Found: username=" . htmlspecialchars($row['username']) . ", role=" . htmlspecialchars($row['role']) . "</p>";
        echo "<p>password_verify(...) => " . ($ok ? "<span style='color:green'>TRUE</span>" : "<span style='color:red'>FALSE</span>") . "</p>";
    } else {
        echo "<p style='color:red;'>No user found for that email/username.</p>";
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
echo "<p style='color:orange;'>After checking, delete this file for security.</p>";
?>
