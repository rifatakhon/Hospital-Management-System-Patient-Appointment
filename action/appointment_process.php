<?php
session_start();
// Process the appointment request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $doctor_id = $_POST["doctor"];

    // Check if patient with the same email already exists
    $conn = mysqli_connect("localhost", "root", "", "hospital_management");
    $query = "SELECT * FROM patients WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        mysqli_close($conn);

        // Set a flash message to indicate duplicate entry
        $_SESSION["flash_message"] = "Patient with the same email already exists.";
        header("Location: ../index.php");
        exit();
    }

    // Save patient details in the database
    $query = "INSERT INTO patients (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
    mysqli_query($conn, $query);
    $patient_id = mysqli_insert_id($conn);

    // Check available slots for the selected doctor
    $query = "SELECT available_slots FROM doctors WHERE doctor_id = $doctor_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $available_slots = $row["available_slots"];

    if ($available_slots > 0) {
        // Create appointment
        $query = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time) VALUES ($patient_id, $doctor_id, CURDATE(), CURTIME())";
        mysqli_query($conn, $query);

        // Update available slots for the selected doctor
        $query = "UPDATE doctors SET available_slots = available_slots - 1 WHERE doctor_id = $doctor_id";
        mysqli_query($conn, $query);

        // Fetch appointment details
        $appointment_id = mysqli_insert_id($conn);
        $query = "SELECT doctors.name AS doctor_name, appointment_date, appointment_time FROM appointments JOIN doctors ON appointments.doctor_id = doctors.doctor_id WHERE appointment_id = $appointment_id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $doctor_name = $row['doctor_name'];
        $appointment_date = $row['appointment_date'];
        $appointment_time = $row['appointment_time'];

        // Inform the patient
        $message = "Your appointment with Dr. $doctor_name has been confirmed for $appointment_date at $appointment_time. Please arrive on time.";
        // Send an email or SMS to the patient with the appointment details

        // Set a flash message to indicate successful booking
        $_SESSION["flash_message"] = "Appointment booked successfully!";
        header("Location: ../patient/index.php");
        exit();
    } else {
        mysqli_close($conn);

        // Set a flash message to indicate no available slots
        $_SESSION["flash_message"] = "Selected doctor does not have available slots.";
        header("Location: ../index.php");
        exit();
    }
}
?>
