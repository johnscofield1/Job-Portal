<?php
require_once __DIR__ . '/partials/header.php';
if (!isset($_SESSION['userid'])) { echo '<p>Login to see notifications.</p>'; require_once __DIR__ . '/partials/footer.php'; exit; }
echo '<h1>Notifications (scaffold)</h1><p>Notifications will appear here.</p>';
require_once __DIR__ . '/partials/footer.php';
