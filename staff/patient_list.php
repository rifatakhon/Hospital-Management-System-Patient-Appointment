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

              // Fetch all patients from the database
              $query = "SELECT * FROM patients";
              $result = mysqli_query($conn, $query);

              // Check if there are any patients
              if (mysqli_num_rows($result) > 0) {
                ?>
               <table class="table align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php


                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . $row['patient_id'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['phone'] . "</td>
                            <td>" . $row['address'] . "</td>
                            <td>
                              <a href='update_patient.php?patient_id=" . $row['patient_id'] . "'>Update</a>
                          </td>
                          </tr>";
                }
                ?>
              </tbody>
              </table>
              <?php } else {
                  echo "No patients found.";
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