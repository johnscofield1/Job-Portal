<?php
require_once __DIR__ . '/partials/header.php'; // include header if exists
//session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'employer') {
    echo "<p>Access denied: employers only.</p>";
    require_once __DIR__ . '/partials/footer.php';
    exit;
}

$employer_name = $_SESSION['username'] ?? 'Employer';
?>

<h1>Welcome, <?= htmlspecialchars($employer_name) ?></h1>

<p>
    <a href="MyJobs.php">My Jobs</a> | 
    <a href="CreateJob.php">Create New Job</a> | 
    <a href="../control/logout.php">Logout</a>
</p>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
