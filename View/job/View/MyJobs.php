<?php
require_once __DIR__ . '/partials/header.php'; // header likely starts session
require_once __DIR__ . '/../Model/db.php';
require_once __DIR__ . '/../Model/jobs_model.php';

// Access check
if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'employer') {
    echo '<p>Access denied: employers only.</p>';
    require_once __DIR__ . '/partials/footer.php';
    exit;
}

$employer_id = $_SESSION['userid'];

// Fetch jobs created by this employer
$conn = createCon();
$sql = "SELECT * FROM jobs WHERE employer_id = ? ORDER BY id DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $employer_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$jobs = [];
while ($r = mysqli_fetch_assoc($res)) $jobs[] = $r;
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<h1>My Jobs</h1>
<p><a href="CreateJob.php">Create New Job</a></p>

<?php if (empty($jobs)): ?>
    <p>You have not posted any jobs yet.</p>
<?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Company</th>
            <th>Location</th>
            <th>Category</th>
            <th>Salary</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($jobs as $job): ?>
            <tr>
                <td><?= htmlspecialchars($job['id']) ?></td>
                <td><?= htmlspecialchars($job['title']) ?></td>
                <td><?= htmlspecialchars($job['company']) ?></td>
                <td><?= htmlspecialchars($job['location']) ?></td>
                <td><?= htmlspecialchars($job['category']) ?></td>
                <td><?= htmlspecialchars($job['salary']) ?></td>
                <td>
                    <a href="../control/job_control.php?action=view&id=<?= $job['id'] ?>">Edit</a> |
                    <a href="../control/job_control.php?action=delete&id=<?= $job['id'] ?>"
                       onclick="return confirm('Are you sure you want to delete this job?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
