<?php
require_once __DIR__ . '/partials/header.php';
?>

<h2>Create New Job</h2>
<form action="../control/job_control.php" method="POST">
    <input type="hidden" name="action" value="create">
    <label>Title: <input type="text" name="title" required></label><br>
    <label>Company: <input type="text" name="company" required></label><br>
    <label>Location: <input type="text" name="location"></label><br>
    <label>Category: <input type="text" name="category"></label><br>
    <label>Description:<br>
        <textarea name="description"></textarea>
    </label><br>
    <label>Requirements:<br>
        <textarea name="requirements"></textarea>
    </label><br>
    <label>Salary: <input type="text" name="salary"></label><br>
    <button type="submit">Create Job</button>
</form>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
