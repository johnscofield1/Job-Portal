<?php
// list_view_files.php — diagnostic. Remove/delete after use.
$dir = __DIR__;
$files = scandir($dir);
echo "<h3>Files in " . htmlspecialchars($dir) . "</h3><ul>";
foreach ($files as $f) {
    echo "<li>" . htmlspecialchars($f) . "</li>";
}
echo "</ul>";
