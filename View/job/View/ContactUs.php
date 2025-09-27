
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="../Asset/styles/ContactUS_style.css">
</head>
<body>
    <div class="nav">
        <a href="LandingPage.php" class="btn green">Home</a>
        <a href="dashboard_new.php" class="btn darkgreen">Dashboard</a>
    </div>

    <center>
        <fieldset class="contact-container">
            <h1>Get in Touch</h1>
            <form onsubmit="return validateForm()">
                <table>
                    <tr>
                        <td>First Name:</td>
                        <td>
                            <input type="text" id="firstName" placeholder="Please enter first name...">
                        </td>
                        <td><span id="firstNameError" class="error-text"></span></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <input type="email" id="email" placeholder="Please enter email...">
                        </td>
                        <td><span id="emailError" class="error-text"></span></td>
                    </tr>
                    <tr>
                        <td>Subject:</td>
                        <td>
                            <select id="subject">
                                <option value="">Choose a Topic</option>
                                <option>General Inquiry</option>
                                <option>Technical Support</option>
                                <option>Other</option>
                            </select>
                        </td>
                        <td><span id="subjectError" class="error-text"></span></td>
                    </tr>
                    <tr>
                        <td>Message:</td>
                        <td>
                            <textarea id="message" placeholder="Please enter query..."></textarea>
                        </td>
                        <td><span id="messageError" class="error-text"></span></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center;">
                            <button type="submit" class="submit-btn">Submit</button>
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </center>

    <script src="../Asset/scripts/contact_validation.js"></script>
</body>
</html>
