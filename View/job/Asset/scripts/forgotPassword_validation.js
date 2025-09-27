function validateForgotPassword() {
    const phone = document.getElementById("phone").value.trim();
    const phoneError = document.getElementById("phoneError");
    const phonePattern = /^\d{10}$/;

    phoneError.textContent = "";

    if (!phonePattern.test(phone)) {
        phoneError.textContent = "==> Enter a valid 10-digit phone number";
        return false;
    }
    return true;
}