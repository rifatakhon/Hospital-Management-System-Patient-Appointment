<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "hospital_management");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST["patient_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Update the patient record in the database
    $query = "UPDATE patients SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE patient_id = $patient_id";
    mysqli_query($conn, $query);

    mysqli_close($conn);

    // Set a flash message to indicate successful patient record update
    $_SESSION["flash_message"] = "Patient record updated successfully!";
    header("Location: patient_list.php");
    exit();
}

?>