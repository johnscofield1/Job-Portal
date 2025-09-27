<?php
require_once __DIR__ . '/db.php';

function applyToJob($job_id, $applicant_id, $resume_path = null, $cover_letter = null) {
    $conn = createCon();
    $sql = "INSERT INTO applications (job_id, applicant_id, resume_path, cover_letter) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'iiss', $job_id, $applicant_id, $resume_path, $cover_letter);
    $res = mysqli_stmt_execute($stmt);
    $id = $res ? mysqli_insert_id($conn) : false;
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $id;
}

function getApplicationsForJob($job_id) {
    $conn = createCon();
    $sql = "SELECT a.*, u.username, u.email FROM applications a JOIN users u ON a.applicant_id = u.id WHERE a.job_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $job_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $rows = []; while ($r = mysqli_fetch_assoc($res)) $rows[] = $r;
    mysqli_stmt_close($stmt); mysqli_close($conn); return $rows;
}
?>