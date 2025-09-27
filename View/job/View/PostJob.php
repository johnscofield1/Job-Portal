<?php
require_once __DIR__ . '/partials/header.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'employer') { echo '<p>Access denied: employers only.</p>'; require_once __DIR__ . '/partials/footer.php'; exit; }
?>
<h1>Post a Job</h1>
<form method="post" action="../Control/job_control.php?action=create">
  <div class="mb-2"><input class="form-control" name="title" placeholder="Job title" required></div>
  <div class="mb-2"><input class="form-control" name="company" placeholder="Company / Organization"></div>
  <div class="mb-2"><input class="form-control" name="location" placeholder="Location"></div>
  <div class="mb-2"><input class="form-control" name="category" placeholder="Category"></div>
  <div class="mb-2"><textarea class="form-control" name="description" placeholder="Description"></textarea></div>
  <div class="mb-2"><textarea class="form-control" name="requirements" placeholder="Requirements"></textarea></div>
  <div class="mb-2"><input class="form-control" name="salary" placeholder="Salary (text)"></div>
  <button class="btn btn-primary">Post Job</button>
</form>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
