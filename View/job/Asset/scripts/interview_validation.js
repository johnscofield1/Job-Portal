function validateInterviewForm() {
    const date = document.getElementById("date").value;
    const time = document.getElementById("time").value;
    const dateError = document.getElementById("dateError");
    const timeError = document.getElementById("timeError");
    const confirmation = document.getElementById("confirmation");

    dateError.textContent = "";
    timeError.textContent = "";
    confirmation.textContent = "";

    let isValid = true;

    if (!date) {
        dateError.textContent = "==> Please select a date";
        isValid = false;
    }
    if (!time) {
        timeError.textContent = "==> Please select a time slot";
        isValid = false;
    }

    if (isValid) {
        confirmation.textContent = `✅ Your interview has been scheduled on ${date} at ${time}`;
    }

    return false; // Prevent real submission
}
