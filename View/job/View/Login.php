
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="../Asset/styles/login_style.css">
</head>
<body>
    <div class="nav-links">
        <a href="LandingPage.php" class="btn green">Home</a>
        <a href="SignUp.php" class="btn darkgreen">Signup</a>
    </div>

    <center>
        <fieldset class="login-container">
            <h1>Login Form</h1>
            <form onsubmit="return validateForm()" action="../Control/login_control.php"  method="POST">
                <table>
                    <tr>
                        <td>ID:</td>
                        <td><input type="text" name="id" id="name" /></td>
                        <td><span id="phoneError" class="error-text"></span></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" id="password"/></td>
                        <td><span id="passwordError" class="error-text"></span></td>
                    </tr>
                    <?php
                        if (isset($_GET['error'])) {
                        echo "<p style='color:red;'>Invalid username or password</p>";
                        }
                    ?>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button type="submit" class="btn green2">Login</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top: 10px;">
                            <a href="forgotPassword.php" class="btn red">Forgot Password?</a>
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </center>

    <script src="../Asset/scripts/login_Validation.js"></script>
</body>
</html>
