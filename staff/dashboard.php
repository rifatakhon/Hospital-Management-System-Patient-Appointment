<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>
<?php
// Assuming you have a database connection established
$conn = mysqli_connect("localhost", "root", "", "hospital_management");
// Count total doctors
$query = "SELECT COUNT(*) AS total_doctors FROM doctors";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_doctors = $row['total_doctors'];

// Count total patients
$query = "SELECT COUNT(*) AS total_patients FROM patients";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_patients = $row['total_patients'];

// Count total pending appointments
$query = "SELECT COUNT(*) AS total_pending_appointments FROM appointments WHERE approval_status = 'Pending'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_pending_appointments = $row['total_pending_appointments'];

// Count total approved appointments
$query = "SELECT COUNT(*) AS total_approved_appointments FROM appointments WHERE approval_status = 'Approved'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_approved_appointments = $row['total_approved_appointments'];

// Close the database connection
mysqli_close($conn);
?>


    <!--start main content-->
     <main class="page-content">
      <?php

        // Check if a flash message exists and display it
        if (isset($_SESSION["flash_message"])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    ' . $_SESSION["flash_message"] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            unset($_SESSION["flash_message"]); // Remove the flash message from the session
        }
      ?>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
        <div class="col">
          <div class="card radius-10 border-0 border-start border-primary border-4">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="">
                  <p class="mb-1">Total Doctors</p>
                  <h4 class="mb-0 text-primary"><?php echo $total_doctors; ?></h4>
                </div>
                <div class="ms-auto widget-icon bg-primary text-white">
                  <i class="bi bi-people-fill"></i>
                </div>
              </div>
              <div class="progress mt-3" style="height: 4.5px;">
                <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
         </div>
         <div class="col">
          <div class="card radius-10 border-0 border-start border-success border-4">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="">
                  <p class="mb-1">Total Patient</p>
                  <h4 class="mb-0 text-success"><?php echo $total_patients; ?></h4>
                </div>
                <div class="ms-auto widget-icon bg-success text-white">
                  <i class="bi bi-people-fill"></i>
                </div>
              </div>
              <div class="progress mt-3" style="height: 4.5px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
         </div>
         <div class="col">
          <div class="card radius-10 border-0 border-start border-danger border-4">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="">
                  <p class="mb-1">Total Pendind Appointment</p>
                  <h4 class="mb-0 text-danger"><?php echo $total_pending_appointments; ?></h4>
                </div>
                <div class="ms-auto widget-icon bg-danger text-white">
                  <i class="bi bi-people-fill"></i>
                </div>
              </div>
              <div class="progress mt-3" style="height: 4.5px;">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
         </div>
         <div class="col">
          <div class="card radius-10 border-0 border-start border-warning border-4">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="">
                  <p class="mb-1">Total Approved Appointment</p>
                  <h4 class="mb-0 text-warning"><?php echo $total_approved_appointments; ?></h4>
                </div>
                <div class="ms-auto widget-icon bg-warning text-dark">
                  <i class="bi bi-people-fill"></i>
                </div>
              </div>
              <div class="progress mt-3" style="height: 4.5px;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
         </div>
      </div><!--end row-->

      

       <div class="card">
        <div class="card-header">
          <h3>Appointment Approval</h3>
        </div>
        <div class="card-body">
          <div class="customer-table">
            <div class="table-responsive white-space-nowrap">
               <table class="table align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Appointment Date & Time</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $conn = mysqli_connect("localhost", "root", "", "hospital_management");

                  // Fetch appointments with "Pending" status and join with patients and doctors
                  $query = "SELECT appointments.appointment_id, patients.name AS patient_name, doctors.name AS doctor_name, appointments.appointment_date, appointments.appointment_time, appointments.approval_status
                            FROM appointments
                            JOIN patients ON appointments.patient_id = patients.patient_id
                            JOIN doctors ON appointments.doctor_id = doctors.doctor_id
                            WHERE appointments.approval_status = 'Pending'";
                  $result = mysqli_query($conn, $query);

                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . $row['appointment_id'] . "</td>
                            <td>" . $row['patient_name'] . "</td>
                            <td>" . $row['doctor_name'] . "</td>
                            <td>
                              <form method='POST' action='update_appointment.php'>
                                <input type='hidden' name='appointment_id' value='" . $row['appointment_id'] . "'>
                                <div class='mb-2'>
                                  <input type='date' class='form-control' name='new_appointment_date' value='" . $row['appointment_date'] . "'>
                                </div>
                                <div class='mb-2'>
                                  <input type='time' class='form-control' name='new_appointment_time' value='" . $row['appointment_time'] . "'>
                                </div>
                                <button type='submit' class='btn btn-primary'>Update</button>
                              </form>
                            </td>
                            <td>" . $row['approval_status'] . "</td>
                            <td>
                              <form method='POST' action='approve_appointment.php'>
                                <input type='hidden' name='appointment_id' value='" . $row['appointment_id'] . "'>
                                <button type='submit' class='btn btn-success'>Approve</button>
                              </form>
                            </td>
                          </tr>";
                  }

                  mysqli_close($conn);
                  ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>

        
     </main>
     <!--end main content-->
     <?php include 'include/footer.php' ?>