<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
</head>
<body style="background-color: rgb(134, 173, 173);">
    <div style="text-align: center; margin: 20px;">
        <a href="LandingPage.php" style="margin: 0 10px; padding: 6px 12px; background-color: #4CAF50; color: white;">Home</a>
        <a href="Login.php" style="margin: 0 10px; padding: 6px 12px; background-color: #235106; color: white;">Login</a>
    </div>
    <center>
    <fieldset style="width: 400px; height: 250px; background-color: antiquewhite;">
        <h1>Reset Password</h1>
        <form onsubmit="return validateResetPassword()">
            <table>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" id="new_password" /></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" id="confirm_password" /></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center; padding-top: 10px;">
                        <button type="submit">Reset Password</button>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    </center>
    <script src="../Asset/scripts/resetPassword_validation.js"></script>
</body>
</html>