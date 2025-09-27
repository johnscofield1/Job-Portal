<?php
session_start();
require_once __DIR__ . '/../Model/db.php';
require_once __DIR__ . '/../Model/jobs_model.php';

// Determine action from POST or GET
$action = $_POST['action'] ?? $_GET['action'] ?? 'list';

switch ($action) {

    // ===== CREATE JOB =====
    case 'create':
        if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'employer') {
            echo 'Access denied'; exit;
        }
        $id = createJob(
            $_SESSION['userid'],
            $_POST['title'] ?? '',
            $_POST['company'] ?? '',
            $_POST['location'] ?? '',
            $_POST['category'] ?? '',
            $_POST['description'] ?? '',
            $_POST['requirements'] ?? '',
            $_POST['salary'] ?? ''
        );
        if ($id) header('Location: ../View/MyJobs.php');
        else echo 'Failed to create job';
        exit;

    // ===== LIST ALL JOBS =====
    case 'list':
        $jobs = getAllJobs();
        require_once __DIR__ . '/../View/JobListings.php';
        exit;

    // ===== VIEW SINGLE JOB =====
    case 'view':
        $job_id = $_GET['id'] ?? 0;
        $job = getJobById($job_id);
        if (!$job) { echo 'Job not found'; exit; }
        require_once __DIR__ . '/../View/JobDetail.php';
        exit;

    // ===== UPDATE JOB =====
    case 'update':
        if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'employer') {
            echo 'Access denied'; exit;
        }
        $job_id = $_POST['id'] ?? 0;
        $success = updateJob(
            $job_id,
            $_POST['title'] ?? '',
            $_POST['company'] ?? '',
            $_POST['location'] ?? '',
            $_POST['category'] ?? '',
            $_POST['description'] ?? '',
            $_POST['requirements'] ?? '',
            $_POST['salary'] ?? ''
        );
        if ($success) header('Location: ../View/MyJobs.php');
        else echo 'Failed to update job';
        exit;

    // ===== DELETE JOB =====
    case 'delete':
        if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'employer') {
            echo 'Access denied'; exit;
        }
        $job_id = $_GET['id'] ?? 0;
        $success = deleteJob($job_id);
        if ($success) header('Location: ../View/MyJobs.php');
        else echo 'Failed to delete job';
        exit;

    default:
        echo 'Invalid action';
        exit;
}
?>
