<?php
require_once __DIR__ . '/partials/header.php';
?>

<h2>Update Job</h2>
<form action="../control/job_control.php" method="POST">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="id" value="<?= htmlspecialchars($job['id']) ?>">
    
    <label>Title: <input type="text" name="title" value="<?= htmlspecialchars($job['title']) ?>" required></label><br>
    <label>Company: <input type="text" name="company" value="<?= htmlspecialchars($job['company']) ?>" required></label><br>
    <label>Location: <input type="text" name="location" value="<?= htmlspecialchars($job['location']) ?>"></label><br>
    <label>Category: <input type="text" name="category" value="<?= htmlspecialchars($job['category']) ?>"></label><br>
    <label>Description:<br>
        <textarea name="description"><?= htmlspecialchars($job['description']) ?></textarea>
    </label><br>
    <label>Requirements:<br>
        <textarea name="requirements"><?= htmlspecialchars($job['requirements']) ?></textarea>
    </label><br>
    <label>Salary: <input type="text" name="salary" value="<?= htmlspecialchars($job['salary']) ?>"></label><br>
    <button type="submit">Update Job</button>
</form>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
