<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
</head>
<body style="background-color: rgb(134, 173, 173);">
   
    <center>
    <fieldset style="width: 400px; height: 250px; background-color: antiquewhite;">
        <h1>Forgot Password</h1>
        <form onsubmit="return validateForgotPassword()">
            <table>
                <tr>
                    <td>Enter Phone Number:</td>
                    <td><input type="tel" name="phone" id="phone" /></td>
                    <td><span id="phoneError"></span></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center; padding-top: 10px;">
                        <button type="submit">Send Reset Link</button>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
     <div style="text-align: center; margin: 20px;">
        <a href="LandingPage.php" style="margin: 0 10px; padding: 6px 12px; background-color: #4CAF50; color: white;">Home</a>
        <a href="login.php" style="margin: 0 10px; padding: 6px 12px; background-color: #235106; color: white;">Login</a>
    </div>
    </center>
    <script src="../Asset/scripts/forgotPassword_validation.js"></script>
</body>
</html>