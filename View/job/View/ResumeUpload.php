

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Resume Upload</title>
</head>
<body style="background-color: rgb(134, 173, 173); font-family: Arial, sans-serif;">
    <div style="text-align: center; margin: 20px;">
        <a href="LandingPage.php" style="padding: 6px 12px; background-color: #4CAF50; color: white; text-decoration: none;">Home</a>
        <a href="dashboard_new.php" style="padding: 6px 12px; background-color: #4CAF50; color: white; text-decoration: none;">Dashboard</a>

    </div>
    
    <center>
    <fieldset style="width: 600px; background-color: antiquewhite; padding: 20px; border-radius: 8px;">
        <h1>Upload Your Resume</h1>
        <form onsubmit="return validateResume()" enctype="multipart/form-data">
            <input type="file" id="resume" accept=".pdf,.doc,.docx" style="margin: 15px;"/>
            <br>
            <span id="resumeError" style="color: red;"></span>
            <br>
            <button type="submit" 
                    style="padding: 10px 30px; background-color: #810513; color: white; border: none; border-radius: 4px;">
                Upload
            </button>
        </form>
        <p id="uploadStatus" style="color: green; margin-top: 15px;"></p>
    </fieldset>
    </center>

    <script src="../Asset/scripts/resume_validation.js"></script>
</body>
</html>
