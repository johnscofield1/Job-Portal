function validateForm() {
    let firstname = document.getElementById("firstname").value.trim();
    let lastname = document.getElementById("lastname").value.trim();
    let id = document.getElementById("id").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let password = document.getElementById("password").value.trim();
    let dob = document.getElementById("dob").value;
    let gender = document.querySelector('input[name="gender"]:checked');

    // Error elements
    let firstNameError = document.getElementById("firstNameError");
    let lastNameError = document.getElementById("lastNameError");
    let idError = document.getElementById("idError");
    let emailError = document.getElementById("emailError");
    let phoneError = document.getElementById("phoneError");
    let passwordError = document.getElementById("passwordError");
    let dobError = document.getElementById("dobError");
    let genderError = document.getElementById("genderError");

    // Clear previous errors
    firstNameError.innerText = "";
    lastNameError.innerText = "";
    idError.innerText = "";
    emailError.innerText = "";
    phoneError.innerText = "";
    passwordError.innerText = "";
    dobError.innerText = "";
    genderError.innerText = "";

    let isValid = true;
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const phonePattern = /^\d{10}$/;

    // Validation checks
    if (firstname === "") {
        firstNameError.innerText = "==> First Name is required";
        isValid = false;
    }
    if (lastname === "") {
        lastNameError.innerText = "==> Last Name is required";
        isValid = false;
    }
    if (id === "") {
        idError.innerText = "==> ID is required";
        isValid = false;
    }
    if (!emailPattern.test(email)) {
        emailError.innerText = "==> Enter a valid email";
        isValid = false;
    }
    if (!phonePattern.test(phone)) {
        phoneError.innerText = "==> Enter a valid 10-digit phone number";
        isValid = false;
    }
    if (password.length < 6) {
        passwordError.innerText = "==> Password must be at least 6 characters";
        isValid = false;
    }
    if (dob === "") {
        dobError.innerText = "==> Date of Birth is required";
        isValid = false;
    }
    if (!gender) {
        genderError.innerText = "==> Please select a gender";
        isValid = false;
    }

    if (isValid) {
        alert("Your Account Has Been Created");
    }
    return isValid;
}