<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_id = $_POST["appointment_id"];

    // Update the appointment status to "Approved" in the database
    $conn = mysqli_connect("localhost", "root", "", "hospital_management");
    $query = "UPDATE appointments SET approval_status = 'Approved' WHERE appointment_id = $appointment_id";
    mysqli_query($conn, $query);
    mysqli_close($conn);

    // Set a flash message to indicate successful doctor deletion
    $_SESSION["flash_message"] = "Appointment approved successfully!";
    header("Location: dashboard.php");
}
?>