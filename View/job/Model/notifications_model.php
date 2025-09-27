<?php
require_once __DIR__ . '/db.php';

function addNotification($user_id, $title, $body) {
    $conn = createCon();
    $stmt = mysqli_prepare($conn, 'INSERT INTO notifications (user_id, title, body) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'iss', $user_id, $title, $body);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt); mysqli_close($conn); return $res;
}

function getNotifications($user_id) {
    $conn = createCon();
    $stmt = mysqli_prepare($conn, 'SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC');
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $rows = []; while ($r = mysqli_fetch_assoc($res)) $rows[] = $r;
    mysqli_stmt_close($stmt); mysqli_close($conn); return $rows;
}
?>