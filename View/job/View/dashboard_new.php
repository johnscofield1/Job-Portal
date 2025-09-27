<?php
session_start(); 
include "../Model/db.php";

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id']; 
} else {
    echo "Unauthorized access.";
    exit();
}

$conn = createCon();
$sql = "SELECT * FROM registration WHERE id='$id'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../Asset/styles/Dashboard.css">
</head>
<body>
    <div class="top-bar">
        <a href="LandingPage.php" class="btn green">Home</a>
        <a href="./Login.php" class="btn red" onclick="performLogout()">Logout</a>
    </div>

    <center>
        <fieldset class="dashboard-container">
            <h1>User Dashboard</h1>

            <!-- Quick Actions -->
            <table class="quick-actions">
                <tr>
                    <td><a href="ResumeUpload.php" class="action-link maroon">Upload Resume</a></td>
                    <td><a href="InterviewSchedule.php" class="action-link gold">Schedule Interview</a></td>
                    <td><a href="CareerResources.php" class="action-link purple">Career Resources</a></td>
                    <td><a href="CompanyProfiles.php" class="action-link orange">Company Profiles</a></td>
                </tr>
                <tr>
                    <td><a href="ForgotPassword.php" class="action-link skyblue">Profile Settings</a></td>
                    <td><a href="500.php" class="action-link green">My Appointments</a></td>
                </tr>
            </table>

            <!-- Account Summary -->
            <fieldset class="summary-section">
                <legend>Account Summary</legend>
                <table class="summary-table">
                    <tr><td>Member Since:</td><td>[Registration Date]</td></tr>
                    <tr><td>Last Login:</td><td>[Last Login Time]</td></tr>
                    <tr><td>Account Status:</td><td class="status-active">Active</td></tr>
                </table>
            </fieldset>

            <!-- Recent Activity -->
            <fieldset class="summary-section">
                <legend>Recent Activity</legend>
                <table class="summary-table">
                    <tr><td>➤ Last Password Change:</td><td>[2023-08-01]</td></tr>
                    <tr><td>➤ Recent Login:</td><td>[2023-08-20 14:30]</td></tr>
                </table>
            </fieldset>

            <!-- Inserted PHP Output Section -->
            <fieldset class="summary-section">
                <legend>User Info From Database</legend>
                <div class="summary-table">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result); // array er kaj kore

                        echo "<h2>Welcome : " . $row['id'] . "</h2>";
                        echo "First Name: " . $row['fname'] . "<br><br>";
                        echo "Last Name: " . $row['lname'] . "<br><br>";
                        echo "Email : " . $row['email'] . "<br><br>" ;
                        echo "Phone : " . $row['phone'] . "<br><br>";

                        // echo '<h3>Press <a href="../Control/logout.php" style="color: red; text-decoration: none;">here</a> for logout</h3>';
                    } else {
                        echo "User Not Found";
                    }

                    closeCon($conn);
                    ?>
                </div>
            </fieldset>

            <!-- Footer -->
            <div class="footer-actions">
                <a href="404.php" class="btn darkgreen">Settings</a>
                <a href="ContactUs.php" class="btn red">Support</a>
                <a href="ContactUs.php" class="btn green">Help</a>
            </div>
        </fieldset>
    </center>

    <script>
        function performLogout() {
            localStorage.removeItem('authToken');//লোকাল স্টোরেজ থেকে authToken ডিলিট করে
            window.location.href = 'login.php';
        }
    </script>
</body>
</html>
