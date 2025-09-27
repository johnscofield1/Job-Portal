<?php
require_once __DIR__ . '/db.php';

function createJob($employer_id, $title, $company, $location, $category, $description, $requirements, $salary) {
    $conn = createCon();
    $sql = "INSERT INTO jobs (employer_id, title, company, location, category, description, requirements, salary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'isssssss', $employer_id, $title, $company, $location, $category, $description, $requirements, $salary);
    $res = mysqli_stmt_execute($stmt);
    $id = $res ? mysqli_insert_id($conn) : false;
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $id;
}

function getJobById($id) {
    $conn = createCon();
    $sql = "SELECT j.*, u.username AS employer_name, u.email AS employer_email 
            FROM jobs j JOIN users u ON j.employer_id = u.id 
            WHERE j.id = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $row;
}

function getAllJobs($filters = []) {
    $conn = createCon();
    $sql = "SELECT j.*, u.username AS employer_name 
            FROM jobs j 
            JOIN users u ON j.employer_id = u.id 
            WHERE 1=1";

    // Apply filters
    if (!empty($filters['q'])) {
        $q = addslashes($filters['q']);
        $sql .= " AND (j.title LIKE '%$q%' OR j.description LIKE '%$q%' OR j.requirements LIKE '%$q%')";
    }
    if (!empty($filters['location'])) {
        $loc = addslashes($filters['location']);
        $sql .= " AND j.location LIKE '%$loc%'";
    }
    if (!empty($filters['category'])) {
        $cat = addslashes($filters['category']);
        $sql .= " AND j.category = '$cat'";
    }
    if (!empty($filters['company'])) {
        $comp = addslashes($filters['company']);
        $sql .= " AND j.company LIKE '%$comp%'";
    }

    $res = mysqli_query($conn, $sql);
    $rows = [];
    while ($r = mysqli_fetch_assoc($res)) $rows[] = $r;
    mysqli_close($conn);
    return $rows;
}

function updateJob($id, $title, $company, $location, $category, $description, $requirements, $salary) {
    $conn = createCon();
    $sql = "UPDATE jobs SET title=?, company=?, location=?, category=?, description=?, requirements=?, salary=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $title, $company, $location, $category, $description, $requirements, $salary, $id);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $res;
}

function deleteJob($id) {
    $conn = createCon();
    $sql = "DELETE FROM jobs WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $res;
}
?>
