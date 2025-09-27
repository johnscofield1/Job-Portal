<?php
require_once __DIR__ . '/partials/header.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'employer') { echo '<p>Access denied: employers only.</p>'; require_once __DIR__ . '/partials/footer.php'; exit; }

echo '<h1>Applications (scaffold)</h1>';
echo '<p>Employer will see applicants here.</p>';
require_once __DIR__ . '/partials/footer.php';
