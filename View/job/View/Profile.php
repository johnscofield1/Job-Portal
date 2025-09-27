<?php
require_once __DIR__ . '/partials/header.php';
if (!isset($_SESSION['userid'])) { header('Location: Login.php'); exit; }
require_once __DIR__ . '/../Model/profiles_model.php';
$profile = getProfile($_SESSION['userid']);
?>
<h1>My Profile</h1>
<p>This is a scaffold for profile view/edit.</p>
<?php if ($profile) echo '<pre>' . htmlspecialchars(print_r($profile, true)) . '</pre>'; ?>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
