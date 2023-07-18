<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check username and password against the staff/assistant credentials in the database
    // Replace the database connection details and query with your own
    $conn = mysqli_connect("localhost", "root", "", "hospital_management");
    $query = "SELECT * FROM staff WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Staff/Assistant authenticated successfully
        $_SESSION["staff_username"] = $username;
        header("Location: dashboard.php");
        exit();
    } else {

        mysqli_close($conn);
        // Invalid credentials
        $_SESSION["flash_message"] = "Invalid username or password.";
        header("Location: index.php");
    }

}
?>
