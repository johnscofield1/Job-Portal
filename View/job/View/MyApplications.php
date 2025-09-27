<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../Model/db.php';
require_once __DIR__ . '/../Model/applications_model.php'; // make sure this file has applyToJob() and application queries

// Access control: jobseekers only
if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'jobseeker') {
    echo "<p>Access denied: jobseekers only.</p>";
    require_once __DIR__ . '/partials/footer.php';
    exit;
}

$jobseeker_id = $_SESSION['userid'];

// Fetch applications for this jobseeker
$conn = createCon();
$sql = "SELECT a.id AS application_id, j.title AS job_title, j.company AS employer_name, a.applied_on, a.status
        FROM applications a
        JOIN jobs j ON a.job_id = j.id
        WHERE a.jobseeker_id = ?
        ORDER BY a.applied_on DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $jobseeker_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$applications = [];
while ($row = mysqli_fetch_assoc($res)) $applications[] = $row;
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<h1>My Applications</h1>

<?php if (empty($applications)): ?>
    <p>You have not applied to any jobs yet.</p>
<?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Job Title</th>
            <th>Employer</th>
            <th>Applied On</th>
            <th>Status</th>
        </tr>
        <?php foreach ($applications as $app): ?>
            <tr>
                <td><?= htmlspecialchars($app['application_id']) ?></td>
                <td><?= htmlspecialchars($app['job_title']) ?></td>
                <td><?= htmlspecialchars($app['employer_name']) ?></td>
                <td><?= htmlspecialchars($app['applied_on']) ?></td>
                <td><?= htmlspecialchars($app['status']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<p><a href="JobListings.php">Back to Job Listings</a></p>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
