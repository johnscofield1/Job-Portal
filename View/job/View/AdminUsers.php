<?php
require_once __DIR__ . '/partials/header.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { echo '<p>Access denied: admins only.</p>'; require_once __DIR__ . '/partials/footer.php'; exit; }
?>
<h1>Admin: Users</h1>
<p>Admin user management scaffold: approve employers, block users, etc.</p>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
