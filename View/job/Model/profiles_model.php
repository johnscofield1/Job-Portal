<?php
require_once __DIR__ . '/db.php';

function getProfile($user_id) {
    $conn = createCon();
    $stmt = mysqli_prepare($conn, 'SELECT * FROM profiles WHERE user_id = ? LIMIT 1');
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt); mysqli_close($conn); return $row;
}

function upsertProfile($user_id, $full_name, $phone, $summary, $skills, $education, $experience) {
    $conn = createCon();
    $sql = "INSERT INTO profiles (user_id, full_name, phone, summary, skills, education, experience) VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE full_name=VALUES(full_name), phone=VALUES(phone), summary=VALUES(summary), skills=VALUES(skills), education=VALUES(education), experience=VALUES(experience)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'issssss', $user_id, $full_name, $phone, $summary, $skills, $education, $experience);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt); mysqli_close($conn); return $res;
}
?>