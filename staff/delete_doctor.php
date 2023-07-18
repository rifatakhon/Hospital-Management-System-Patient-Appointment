<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST["doctor_id"];

    // Delete the doctor from the database
    $conn = mysqli_connect("localhost", "root", "", "hospital_management");
    $query = "DELETE FROM doctors WHERE doctor_id = $doctor_id";
    mysqli_query($conn, $query);
    mysqli_close($conn);

    // Set a flash message to indicate successful doctor deletion
    $_SESSION["flash_message"] = "Doctor deleted successfully!";
    header("Location: doctor_list.php");
    exit();
}
?>
