<?php
session_start();
require_once __DIR__ . '/../Model/db.php';
require_once __DIR__ . '/../Model/users_model.php'; // Must have user CRUD functions
require_once __DIR__ . '/../Model/jobs_model.php';  // Must have job CRUD functions

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied. Admins only.";
    exit;
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

$conn = createCon();

// -------------------- USER ACTIONS --------------------
if (in_array($action, ['edit_user', 'update_user', 'delete_user', 'approve_user'])) {
    $user_id = intval($_GET['id'] ?? $_POST['id'] ?? 0);

    if ($action === 'delete_user') {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: ../View/AdminDashboard.php');
        exit;
    }

    if ($action === 'approve_user') {
        $sql = "UPDATE users SET approved = 1 WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: ../View/AdminDashboard.php');
        exit;
    }

    if ($action === 'edit_user') {
        // Redirect to a simple edit form or reuse same dashboard (optional)
        header("Location: ../View/EditUser.php?id=$user_id");
        exit;
    }

    if ($action === 'update_user') {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $role = $_POST['role'] ?? '';
        $approved = isset($_POST['approved']) ? 1 : 0;

        $sql = "UPDATE users SET username=?, email=?, role=?, approved=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssii', $username, $email, $role, $approved, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: ../View/AdminDashboard.php');
        exit;
    }
}

// -------------------- JOB ACTIONS --------------------
if (in_array($action, ['edit_job', 'update_job', 'delete_job'])) {
    $job_id = intval($_GET['id'] ?? $_POST['id'] ?? 0);

    if ($action === 'delete_job') {
        $sql = "DELETE FROM jobs WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $job_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: ../View/AdminDashboard.php');
        exit;
    }

    if ($action === 'edit_job') {
        header("Location: ../View/UpdateJob.php?id=$job_id&admin=1");
        exit;
    }

    if ($action === 'update_job') {
        $title = $_POST['title'] ?? '';
        $company = $_POST['company'] ?? '';
        $location = $_POST['location'] ?? '';
        $category = $_POST['category'] ?? '';
        $description = $_POST['description'] ?? '';
        $requirements = $_POST['requirements'] ?? '';
        $salary = $_POST['salary'] ?? '';

        $sql = "UPDATE jobs SET title=?, company=?, location=?, category=?, description=?, requirements=?, salary=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssssssi', $title, $company, $location, $category, $description, $requirements, $salary, $job_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: ../View/AdminDashboard.php');
        exit;
    }
}

// Default fallback
header('Location: ../View/AdminDashboard.php');
exit;
