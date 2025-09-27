<?php
require_once __DIR__ . '/db.php';

function getAllUsers() {
    $conn = createCon();
    $sql = "SELECT * FROM users ORDER BY role, id";
    $res = mysqli_query($conn, $sql);
    $users = [];
    while ($row = mysqli_fetch_assoc($res)) $users[] = $row;
    mysqli_close($conn);
    return $users;
}

function getUserById($id) {
    $conn = createCon();
    $sql = "SELECT * FROM users WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $row;
}

function updateUser($id, $username, $email, $role, $approved) {
    $conn = createCon();
    $sql = "UPDATE users SET username=?, email=?, role=?, approved=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssii', $username, $email, $role, $approved, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return true;
}

function deleteUser($id) {
    $conn = createCon();
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return true;
}
?>
