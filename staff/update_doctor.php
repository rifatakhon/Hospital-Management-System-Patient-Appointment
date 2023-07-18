<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST["doctor_id"];
    $name = $_POST["name"];
    $specialization = $_POST["specialization"];
    $available_slots = $_POST["available_slots"];

    $conn = mysqli_connect("localhost", "root", "", "hospital_management");

    // Update the doctor's information in the database
    $query = "UPDATE doctors SET name = '$name', specialization = '$specialization', available_slots = $available_slots WHERE doctor_id = $doctor_id";
    mysqli_query($conn, $query);

    mysqli_close($conn);

    // Set a flash message to indicate successful doctor update
    $_SESSION["flash_message"] = "Doctor updated successfully!";
    header("Location: doctor_list.php");
    exit();
}
?>
