<?php include "interviewValidation.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Interview Scheduling</title>
    <link rel="stylesheet" href="../Asset/styles/interview_style.css">
</head>
<body>
    

    <center>
        <fieldset class="interview-box"  style="text-align: left;">
            <h1>Schedule Your Interview</h1>
            <form method="POST">
                <table>
                    <tr>
                        <td>Select Date:</td>
                        <td><input type="date" name="date" id="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : ''; ?>" /></td>
                        <td><span class="error-text"><?php echo $dateError; ?></span></td>
                    </tr>
                    <tr>
                        <td>Select Time Slot:</td>
                        <td>
                            <select name="time" id="time">
                                <option value="">-- Choose a time slot --</option>
                                <option <?php if(isset($_POST['time']) && $_POST['time'] == "10:00 AM") echo "selected"; ?>>10:00 AM</option>
                                <option <?php if(isset($_POST['time']) && $_POST['time'] == "12:00 PM") echo "selected"; ?>>12:00 PM</option>
                                <option <?php if(isset($_POST['time']) && $_POST['time'] == "02:00 PM") echo "selected"; ?>>02:00 PM</option>
                                <option <?php if(isset($_POST['time']) && $_POST['time'] == "04:00 PM") echo "selected"; ?>>04:00 PM</option>
                            </select>
                        </td>
                        <td><span class="error-text"><?php echo $timeError; ?></span></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="submit-cell">
                            <button type="submit" class="confirm-btn">Confirm Interview</button>
                            <a href="dashboard_new.php" class="dashboard-link">Dashboard</a>

                        </td>
                    </tr>
                </table>
                    
                <p class="confirmation-text"><?php echo $confirmation; ?></p>
            </form>
        </fieldset>
    </center>
</body>
</html>
