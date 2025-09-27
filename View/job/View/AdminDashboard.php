<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../Model/db.php';
require_once __DIR__ . '/../Model/users_model.php';  // optional, still used for user functions
require_once __DIR__ . '/../Model/jobs_model.php';   // must contain job CRUD

// Access control: admin only
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<p>Access denied: admins only.</p>";
    require_once __DIR__ . '/partials/footer.php';
    exit;
}

// Database connection
$conn = createCon();

// Fetch all users (removed last_login)
$sql_users = "SELECT id, username, email, role, approved FROM users ORDER BY role, id";
$res_users = mysqli_query($conn, $sql_users);
$users = [];
while ($row = mysqli_fetch_assoc($res_users)) $users[] = $row;

// Fetch all jobs
$sql_jobs = "SELECT j.id, j.title, j.company, j.location, j.category, j.salary, u.username AS employer_name
             FROM jobs j
             JOIN users u ON j.employer_id = u.id
             ORDER BY j.id DESC";
$res_jobs = mysqli_query($conn, $sql_jobs);
$jobs = [];
while ($row = mysqli_fetch_assoc($res_jobs)) $jobs[] = $row;

mysqli_close($conn);
?>

<h1>Admin Dashboard</h1>

<h2>Users</h2>
<?php if (empty($users)): ?>
    <p>No users found.</p>
<?php else: ?>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Approved</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $u): ?>
    <tr>
        <td><?= htmlspecialchars($u['id']) ?></td>
        <td><?= htmlspecialchars($u['username']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td><?= htmlspecialchars($u['role']) ?></td>
        <td><?= $u['approved'] ? 'Yes' : 'No' ?></td>
        <td>
            <a href="../control/admin_control.php?action=edit_user&id=<?= $u['id'] ?>">Edit</a> |
            <a href="../control/admin_control.php?action=delete_user&id=<?= $u['id'] ?>"
               onclick="return confirm('Are you sure you want to delete this user?');">Delete</a> |
            <?php if ($u['approved'] == 0): ?>
                <a href="../control/admin_control.php?action=approve_user&id=<?= $u['id'] ?>">Approve</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

<h2>Jobs</h2>
<?php if (empty($jobs)): ?>
    <p>No jobs found.</p>
<?php else: ?>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Company</th>
        <th>Location</th>
        <th>Category</th>
        <th>Salary</th>
        <th>Employer</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($jobs as $j): ?>
    <tr>
        <td><?= htmlspecialchars($j['id']) ?></td>
        <td><?= htmlspecialchars($j['title']) ?></td>
        <td><?= htmlspecialchars($j['company']) ?></td>
        <td><?= htmlspecialchars($j['location']) ?></td>
        <td><?= htmlspecialchars($j['category']) ?></td>
        <td><?= htmlspecialchars($j['salary']) ?></td>
        <td><?= htmlspecialchars($j['employer_name']) ?></td>
        <td>
            <a href="../control/admin_control.php?action=edit_job&id=<?= $j['id'] ?>">Edit</a> |
            <a href="../control/admin_control.php?action=delete_job&id=<?= $j['id'] ?>"
               onclick="return confirm('Are you sure you want to delete this job?');">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

<p><a href="../control/logout.php">Logout</a></p>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
