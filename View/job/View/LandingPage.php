<!DOCTYPE html>
<html lang="en">
<head>
    <title>Job Portal</title>
    <link rel="stylesheet" href="../Asset/styles/style.css">
</head>
<body>
    <div class="top-bar">
        <div class="auth-buttons">
            <a href="dashboard_new.php" class="signup-btn">Dashboard</a>
            <a href="SignUp.php" class="signup-btn">Create Account</a>
            <a href="Login.php" class="login-btn">Login</a>
        </div>
    </div>

    <center>
        <fieldset class="main-field">
            <header>
                <h1 class="welcome-title">Welcome to Job Portal</h1>
            </header>

            <div class="content">
                <h2 class="headline">
                    Find Your Dream Job <br/>
                    With Your Interest <br/>
                    And Skills
                </h2>

                <!-- Job Search -->
                <div class="job-search">
                    <input type="text" placeholder="Job Title or Keywords">
                    <select>
                        <option>All Locations</option>
                        <option>Dhaka</option>
                        <option>Chittagong</option>
                    </select>
                    <button>
                        <a href="JobListings.php">Search Jobs</a>
                    </button>
                </div>

                <!-- Features -->
                <div class="features">
                    <h3>Why Choose Us?</h3>
                    <ul>
                        <li>1000+ Daily Job Postings</li>
                        <li>Direct Company Applications</li>
                        <li>Free Career Guidance</li>
                        <li>Mobile-Friendly Platform</li>
                    </ul>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="cta-section">
                <h3>Get Started Now!</h3>
                <div class="cta-buttons">
                    <a href="ContactUs.php" class="contact-btn">Contact Us</a>
                    <a href="JobListings.php" class="browse-btn">Browse Jobs</a>
                </div>
            </div>

            <!-- Footer -->
            <footer>
                <p> Find the most exciting startup jobs</p>
                <p> Contact: support@jobportal.com |  Helpline: 017XXXXXXXX</p>
            </footer>
        </fieldset>
    </center>
</body>
</html>
