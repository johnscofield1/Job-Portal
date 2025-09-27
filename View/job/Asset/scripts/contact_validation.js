function validateForm() {
    const firstName = document.getElementById("firstName").value.trim();
    const email = document.getElementById("email").value.trim();
    const subject = document.getElementById("subject").value;
    const message = document.getElementById("message").value.trim();

    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
    // Clear errors
    document.querySelectorAll('[id$="Error"]').forEach(el => el.textContent = '');

    let isValid = true;

    if (firstName === "") {
        document.getElementById("firstNameError").textContent = "==> First name is required";
        isValid = false;
    }
    if (!emailPattern.test(email)) {
        document.getElementById("emailError").textContent = "==> Enter a valid email";
        isValid = false;
    }
    if (subject === "") {
        document.getElementById("subjectError").textContent = "==> Please select a subject";
        isValid = false;
    }
    if (message === "") {
        document.getElementById("messageError").textContent = "==> Message is required";
        isValid = false;
    }

    if (isValid) {
        alert("Thank you! Your message has been submitted.");
    }
    return isValid;
}