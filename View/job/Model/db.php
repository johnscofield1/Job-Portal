<?php
// job/Model/db.php
function createCon()
{
    $conn = mysqli_connect("localhost", "root", "", "jobportal");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

/**
 * insertData($username, $email, $password, $role)
 * - $password should be the plain password; this function will hash it.
 * - returns inserted user id on success, or false on failure.
 */
function insertData($username, $email, $password, $role)
{
    $conn = createCon();
    $hashed = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        mysqli_close($conn);
        return false;
    }
    mysqli_stmt_bind_param($stmt, 'ssss', $username, $email, $hashed, $role);
    $res = mysqli_stmt_execute($stmt);
    if ($res) {
        $insert_id = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $insert_id;
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
}

/**
 * checkLogin($identifier, $password)
 * - $identifier can be username or email
 * - returns associative array of user (id, username, email, role) on success, or false on failure
 */
function checkLogin($identifier, $password)
{
    $conn = createCon();
    $sql = "SELECT id, username, email, password, role FROM users WHERE username = ? OR email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        mysqli_close($conn);
        return false;
    }
    mysqli_stmt_bind_param($stmt, 'ss', $identifier, $identifier);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $hash = $row['password'];
        if (password_verify($password, $hash)) {
            // remove password before returning
            unset($row['password']);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $row;
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return false;
}

function closeCon($conn)
{
    mysqli_close($conn);
}
?>