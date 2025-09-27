<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../Model/jobs_model.php';

$q = $_GET['q'] ?? '';
$location = $_GET['location'] ?? '';
$category = $_GET['category'] ?? '';
$company = $_GET['company'] ?? '';
$jobs = searchJobs($q, $location, $category, $company);
?>
<h1>Job Listings</h1>
<form class="row g-2 mb-3" method="get">
  <div class="col-md-4"><input class="form-control" name="q" placeholder="Search title or description" value="<?php echo htmlspecialchars($q); ?>"></div>
  <div class="col-md-2"><input class="form-control" name="location" placeholder="Location" value="<?php echo htmlspecialchars($location); ?>"></div>
  <div class="col-md-2"><input class="form-control" name="category" placeholder="Category" value="<?php echo htmlspecialchars($category); ?>"></div>
  <div class="col-md-2"><input class="form-control" name="company" placeholder="Company" value="<?php echo htmlspecialchars($company); ?>"></div>
  <div class="col-md-2"><button class="btn btn-primary">Search</button></div>
</form>
<div class="list-group">
<?php foreach ($jobs as $job): ?>
  <a href="JobDetail.php?id=<?php echo $job['id']; ?>" class="list-group-item list-group-item-action">
    <h5 class="mb-1"><?php echo htmlspecialchars($job['title']); ?></h5>
    <p class="mb-1"><?php echo htmlspecialchars($job['company'] ? $job['company'] : $job['employer_name']); ?> • <?php echo htmlspecialchars($job['location']); ?></p>
  </a>
<?php endforeach; ?>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
