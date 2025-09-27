<?php
// run_tests.php
// Safe test runner — works in CLI or browser.
// IMPORTANT: This script will INSERT test rows into your jobportal DB. Run only on development DB.

$sapi = php_sapi_name();
$is_cli = ($sapi === 'cli');
$nl = $is_cli ? PHP_EOL : "<br>\n";
$pre = $is_cli ? "" : "<pre>";
$post = $is_cli ? "" : "</pre>";

echo $pre;
echo "[INFO] Job Portal test runner starting..." . $nl;

// Move working dir to the job/ folder (so relative includes work)
chdir(__DIR__ . "/..");

// Load DB helpers
$db_path = __DIR__ . "/../Model/db.php";
if (!file_exists($db_path)) {
    echo "[ERROR] db.php not found at: $db_path" . $nl;
    echo $post; exit(1);
}
require_once $db_path;

// small printer
function p($msg) {
    global $nl;
    echo "[INFO] " . $msg . $nl;
}

// 1) Connect
$conn = null;
try {
    if (!function_exists('createCon')) {
        echo "[ERROR] createCon() not defined in db.php. Please check job/Model/db.php" . $nl;
    } else {
        $conn = createCon();
        if ($conn) p("DB connected.");
        else { echo "[ERROR] createCon() returned falsy." . $nl; }
    }
} catch (Throwable $e) {
    echo "[ERROR] Exception while connecting DB: " . $e->getMessage() . $nl;
    echo $post; exit(1);
}

// 2) Admin login test
if (function_exists('checkLogin')) {
    $res = checkLogin('admin', 'admin123');
    if (is_array($res)) p("checkLogin('admin','admin123') => SUCCESS (role: " . ($res['role'] ?? 'unknown') . ")");
    else p("checkLogin('admin','admin123') => FAILURE (admin user may be missing or password different)");
} else {
    p("checkLogin() not found — skipping login test");
}

// 3) Create a temporary jobseeker (signup test)
$uid = null;
if (function_exists('insertData')) {
    $email = 'cli_test_user_' . time() . '@example.com';
    $username = 'cli_test_user_' . time();
    $pwd = 'TestPass123!';
    $ins = insertData($username, $email, $pwd, 'jobseeker');
    if ($ins !== false) {
        $uid = $ins;
        p("insertData() created jobseeker id: $ins (email: $email)");
    } else {
        p("insertData() failed to create jobseeker (maybe unique constraint)");
    }
} else {
    p("insertData() not found — skipping signup test");
}

// 4) Create an employer + post job (requires jobs_model.php)
$jid = null;
if (file_exists(__DIR__ . "/../Model/jobs_model.php")) {
    require_once __DIR__ . "/../Model/jobs_model.php";
    if (function_exists('insertData')) {
        $em_email = 'cli_emp_' . time() . '@example.com';
        $em_user = 'cli_emp_' . time();
        $eid = insertData($em_user, $em_email, 'EmpPass123!', 'employer');
        if ($eid !== false) {
            p("Inserted employer id: $eid");
            if (function_exists('createJob')) {
                $jid = createJob($eid, 'CLI Test Job', 'CLI Co', 'Remote', 'Tech', 'Job description', 'Requirements', '0');
                if ($jid) p("createJob() inserted job id: $jid");
                else p("createJob() failed.");
            } else {
                p("createJob() not found — cannot post job.");
            }
        } else {
            p("Failed to create employer (insertData returned false).");
        }
    } else {
        p("insertData() missing — cannot create employer.");
    }
} else {
    p("jobs_model.php not present — skipping employer/job tests.");
}

// 5) Apply to job (requires applications_model.php)
if (file_exists(__DIR__ . "/../Model/applications_model.php")) {
    require_once __DIR__ . "/../Model/applications_model.php";
    if (isset($jid) && isset($uid) && function_exists('applyToJob')) {
        $aid = applyToJob($jid, $uid, null, 'Cover letter from CLI test');
        if ($aid) p("applyToJob() success — application id: $aid");
        else p("applyToJob() failed.");
    } else {
        p("Skipping applyToJob(): missing job id or user id, or function not found.");
    }
} else {
    p("applications_model.php not present — skipping application test.");
}

p("Tests finished. NOTE: test rows were inserted into the DB. Remove them manually if needed.");
echo $post;
