<?php
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "hospital_management");

// Get the appointment ID from the URL parameter
$appointment_id = $_GET['appointment_id'];

// Retrieve the doctor ID associated with the appointment
$query = "SELECT doctor_id FROM appointments WHERE appointment_id = $appointment_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$doctor_id = $row['doctor_id'];

// Delete the appointment from the database
$query = "DELETE FROM appointments WHERE appointment_id = $appointment_id";
mysqli_query($conn, $query);

// Update the available slots for the respective doctor
$query = "UPDATE doctors SET available_slots = available_slots + 1 WHERE doctor_id = $doctor_id";
mysqli_query($conn, $query);

// Close the database connection
mysqli_close($conn);

// Redirect back to the patient appointment list page
header("Location: appointment_list.php");
exit();
?>