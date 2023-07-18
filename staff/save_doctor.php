<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $specialization = $_POST["specialization"];
    $available_slots = $_POST["available_slots"];

    $conn = mysqli_connect("localhost", "root", "", "hospital_management");

    // Insert the new doctor into the database
    $query = "INSERT INTO doctors (name, specialization, available_slots) VALUES ('$name', '$specialization', $available_slots)";
    mysqli_query($conn, $query);

    mysqli_close($conn);

    // Set a flash message to indicate successful doctor addition
    $_SESSION["flash_message"] = "Doctor added successfully!";
    header("Location: doctor_list.php");
    exit();
}
?>
