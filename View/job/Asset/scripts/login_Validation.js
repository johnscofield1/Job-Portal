function validateForm() {
    let name = document.getElementById("name").value.trim();
    let password = document.getElementById("password").value.trim();
    let phoneError = document.getElementById("phoneError");
    let passwordError = document.getElementById("passwordError");

    phoneError.innerText = "";
    passwordError.innerText = "";

    let isValid = true;

    if (name === "") {
        phoneError.innerText = "==> Enter a username";
        isValid = false;
    }
    if (password.length < 6) {
        passwordError.innerText = "==> Password must be at least 6 characters";
        isValid = false;
    }
    return isValid;
}