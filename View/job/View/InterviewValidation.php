<?php
$dateError = "";
$timeError = "";
$confirmation = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Date
    if (empty($_POST["date"])) {
        $dateError = "Please select a date.";
    } else {
        $selectedDate = $_POST["date"];
        $today = date("Y-m-d");
        if ($selectedDate < $today) {
            $dateError = "Date cannot be in the past.";
        }
    }

    // Validate Time
    if (empty($_POST["time"])) {
        $timeError = "Please select a time slot.";
    }

    // If no errors
    if (empty($dateError) && empty($timeError)) {
        $confirmation = "Interview scheduled for $selectedDate at " . $_POST["time"] . ".";
        // You could redirect here or insert into DB if needed
    }
}
?>
