<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../Model/jobs_model.php';

$id = intval($_GET['id'] ?? 0);
$job = getJobById($id);
if (!$job) echo '<p>Job not found.</p>';
else {
?>
<h1><?php echo htmlspecialchars($job['title']); ?></h1>
<p><strong>Company:</strong> <?php echo htmlspecialchars($job['company'] ? $job['company'] : $job['employer_name']); ?></p>
<p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
<p><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'jobseeker'): ?>
  <hr>
  <h4>Apply for this job</h4>
  <form action="../Control/application_control.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
    <div class="mb-2"><label>Cover letter</label><textarea name="cover_letter" class="form-control"></textarea></div>
    <div class="mb-2"><label>Resume (PDF)</label><input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx"></div>
    <button class="btn btn-success">Apply</button>
  </form>
<?php else: ?>
  <p><a class="btn btn-primary" href="Login.php">Login as Jobseeker to apply</a></p>
<?php endif; ?>

<?php } require_once __DIR__ . '/partials/footer.php'; ?>
