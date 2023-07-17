<?php
session_start();
// Process the login request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Authenticate the patient
    $conn = mysqli_connect("localhost", "root", "", "hospital_management");

    $query = "SELECT * FROM patients WHERE email = '$email' AND phone = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Patient authenticated successfully
        $row = mysqli_fetch_assoc($result);

        session_start();
        $_SESSION["patient_email"] = $email;
        $_SESSION["patient_id"] = $row["patient_id"]; // Store patient ID in the session
        $_SESSION["patient_name"] = $row["name"];

        // Set a flash message to indicate successful booking
        $_SESSION["flash_message"] = "Welcome To X Hospital!";
        header("Location: patient_dashboard.php");
        exit();
    } else {
        mysqli_close($conn);
        // Set a flash message to Invalid credentials
        $_SESSION["flash_message"] = "Invalid email or password.";
        header("Location: index.php");
        exit();
    }

}
?>
