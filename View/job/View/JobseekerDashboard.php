<?php
session_start();
require_once __DIR__ . '/../Model/db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'jobseeker') {
    echo "Access denied. Jobseekers only.";
    exit;
}
?>
<!DOCTYPE html>
<html><body>
<h1>Welcome, jobseeker</h1>
<p><a href="Login.php">Logout</a></p>
</body></html>
