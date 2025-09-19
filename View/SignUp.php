<?php
include "SignupValidation.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup Form</title>
    <link rel="stylesheet" href="../Asset/styles/signup_style.css">
</head>
<body>
    <div class="nav-links">
        <a href="LandingPage.php" class="btn green">Home</a>
        <a href="login.php" class="btn darkgreen">Login</a>
    </div>

    <center>
        <fieldset class="signup-container">
            <h1>Signup Form</h1>
            <form method="POST" onsubmit="return validateForm()">
                <table>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="firstname" id="firstname" /></td>
                        <td><span id="firstNameError" class="error-text"><?php echo $fnameError;?></span></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" name="lastname" id="lastname" /></td>
                        <td><span id="lastNameError" class="error-text"><?php echo $lnameError;?></span></td>
                    </tr>
                    <tr>
                        <td>ID:</td>
                        <td><input type="number" name="id" id="id" /></td>
                        <td><span id="idError" class="error-text"><?php echo $idError;?></span></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" id="email" /></td>
                        <td><span id="emailError" class="error-text"><?php echo $emailError;?></span></td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td><input type="tel" name="phone" id="phone" /></td>
                        <td><span id="phoneError" class="error-text"><?php echo $phnError;?></span></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" id="password" /></td>
                        <td><span id="passwordError" class="error-text"><?php echo $passError;?></span></td>
                    </tr>
                    <tr>
                        <td>Date of Birth:</td>
                        <td><input type="date" name="dob" id="dob" /></td>
                        <td><span id="dobError" class="error-text"><?php echo $dobError; ?></span></td>
                    </tr>

                    <tr>
                        <td>Gender:</td>
                        <td>
                            <input type="radio" name="gender" value="male" /> Male
                            <input type="radio" name="gender" value="female" /> Female
                            <input type="radio" name="gender" value="other" /> Other
                        </td>
                        <td><span id="genderError" class="error-text"><?php echo $genderError; ?></span></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:center;">
                            <button type="submit" class="btn red">Register</button>
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </center>

    <script src="../Asset/SignUp_Validation.js"></script>
</body>
</html>
