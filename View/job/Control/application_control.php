<?php
session_start();
require_once __DIR__ . '/../Model/db.php';
require_once __DIR__ . '/../Model/applications_model.php';

if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'jobseeker') {
    header('Location: ../View/Login.php'); exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = intval($_POST['job_id']);
    $cover = $_POST['cover_letter'] ?? '';

    $resume_path = null;
    if (!empty($_FILES['resume']['tmp_name'])) {
        $uploaddir = __DIR__ . '/../uploads/resumes/';
        if (!is_dir($uploaddir)) mkdir($uploaddir, 0o755, True);
        $fname = basename($_FILES['resume']['name']);
        $ext = pathinfo($fname, PATHINFO_EXTENSION);
        $newname = uniqid('resume_') . '.' . $ext;
        $dest = $uploaddir . $newname;
        move_uploaded_file($_FILES['resume']['tmp_name'], $dest);
        $resume_path = 'uploads/resumes/' . $newname;
    }

    $app_id = applyToJob($job_id, $_SESSION['userid'], $resume_path, $cover);
    if ($app_id) header('Location: ../View/JobDetail.php?id=' . $job_id . '&applied=1');
    else echo 'Failed to apply';
}
?>