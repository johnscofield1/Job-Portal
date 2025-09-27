<?php
session_start();
require_once __DIR__ . '/../Model/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied. Admins only.";
    exit;
}

$errors = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($email) || empty($password)) {
        $errors = 'All fields are required.';
    } else {
        $res = insertData($username, $email, $password, 'employer');
        if ($res !== false) {
            header('Location: AdminDashboard.php');
            exit;
        } else {
            $errors = 'Failed to create employer (maybe username/email already exists).';
        }
    }
}
?>
<!DOCTYPE html>
<html><body>
<h1>Add Employer (Admin)</h1>
<?php if ($errors) echo '<p style="color:red;">'.htmlspecialchars($errors).'</p>'; ?>
<form method="POST" action="AddEmployer.php">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Create Employer</button>
</form>
<p><a href="AdminDashboard.php">Back to Dashboard</a></p>
</body></html>
