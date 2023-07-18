<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_id = $_POST["appointment_id"];
    $new_appointment_date = $_POST["new_appointment_date"];
    $new_appointment_time = $_POST["new_appointment_time"];

    $conn = mysqli_connect("localhost", "root", "", "hospital_management");

    // Update the appointment date and time in the database
    $query = "UPDATE appointments SET appointment_date = '$new_appointment_date', appointment_time = '$new_appointment_time' WHERE appointment_id = $appointment_id";
    mysqli_query($conn, $query);

    mysqli_close($conn);

    // Set a flash message to indicate successful update
    $_SESSION["flash_message"] = "Appointment date and time updated successfully!";
    header("Location: dashboard.php");
    exit();
}
?>
