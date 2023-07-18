<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>



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
      <!-- <div class="row">
        <div class="col-auto">
          <div class="d-flex align-items-center gap-2 justify-content-lg-end">
               <a class="btn btn-primary px-4" href="add_doctor.php"><i class="bi bi-list-ol me-2"></i>Add Doctor</a>
            </div>
        </div>
      </div> -->
       <div class="card">
        <div class="card-header">
          <h3>Patient List</h3>
        </div>
        <div class="card-body">
          <div class="customer-table">
            <div class="table-responsive white-space-nowrap">
              <?php
              $conn = mysqli_connect("localhost", "root", "", "hospital_management");

              // Fetch approved appointments from the database
              $query = "SELECT appointments.appointment_id, patients.name AS patient_name, doctors.name AS doctor_name, appointments.appointment_date, appointments.appointment_time
                        FROM appointments
                        JOIN patients ON appointments.patient_id = patients.patient_id
                        JOIN doctors ON appointments.doctor_id = doctors.doctor_id
                        WHERE appointments.approval_status = 'Approved'";
              $result = mysqli_query($conn, $query);

              // Check if there are any patients
              if (mysqli_num_rows($result) > 0) {
                ?>
               <table class="table align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php


                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . $row['appointment_id'] . "</td>
                            <td>" . $row['patient_name'] . "</td>
                            <td>" . $row['doctor_name'] . "</td>
                            <td>" . $row['appointment_date'] . "</td>
                            <td>" . $row['appointment_time'] . "</td>
                            <td>
                              <form method='POST' action='cancel_appointment.php'>
                                <input type='hidden' name='appointment_id' value='" . $row['appointment_id'] . "'>
                                <button type='submit' class='btn btn-danger'>Cancel</button>
                              </form>
                            </td>
                          </tr>";
                }
                ?>
              </tbody>
              </table>
              <?php } else {
                  echo "No approved appointments found.";
              }

              mysqli_close($conn);
              ?>
            </div>
          </div>
        </div>
      </div>

        
     </main>
     <!--end main content-->
     <?php include 'include/footer.php' ?>