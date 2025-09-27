function validateResume() {
    const fileInput = document.getElementById("resume");
    const file = fileInput.files[0];
    const errorSpan = document.getElementById("resumeError");
    const status = document.getElementById("uploadStatus");
    
    errorSpan.textContent = "";
    status.textContent = "";

    if (!file) {
        errorSpan.textContent = "==> Please select a file to upload.";
        return false;
    }

    const allowedTypes = ["application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
    if (!allowedTypes.includes(file.type)) {
        errorSpan.textContent = "==> Only PDF, DOC, or DOCX files are allowed.";
        return false;
    }

    // Simulate success (in real case, backend processing would be needed)
    status.textContent = `✅ ${file.name} uploaded successfully!`;
    return false; // Prevent actual form submission for demo
}
