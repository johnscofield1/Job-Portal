<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../Model/db.php';
require_once __DIR__ . '/../Model/users_model.php';

// Access control: admin only
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<p>Access denied: admins only.</p>";
    require_once __DIR__ . '/partials/footer.php';
    exit;
}

$user_id = intval($_GET['id'] ?? 0);
if ($user_id <= 0) {
    echo "<p>Invalid user ID.</p>";
    require_once __DIR__ . '/partials/footer.php';
    exit;
}

// Fetch user data
$user = getUserById($user_id);
if (!$user) {
    echo "<p>User not found.</p>";
    require_once __DIR__ . '/partials/footer.php';
    exit;
}
?>

<h1>Edit User</h1>

<form action="../control/admin_control.php?action=update_user" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

    <label>Username: <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required></label><br>
    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required></label><br>
    <label>Role:
        <select name="role" required>
            <option value="jobseeker" <?= $user['role'] === 'jobseeker' ? 'selected' : '' ?>>Jobseeker</option>
            <option value="employer" <?= $user['role'] === 'employer' ? 'selected' : '' ?>>Employer</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
    </label><br>
    <label>Approved: <input type="checkbox" name="approved" value="1" <?= $user['approved'] ? 'checked' : '' ?>></label><br>

    <button type="submit">Update User</button>
</form>

<p><a href="AdminDashboard.php">Back to Dashboard</a></p>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
