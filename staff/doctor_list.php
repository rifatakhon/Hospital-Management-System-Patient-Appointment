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
      <div class="row">
        <div class="col-auto">
          <div class="d-flex align-items-center gap-2 justify-content-lg-end">
               <a class="btn btn-primary px-4" href="add_doctor.php"><i class="bi bi-list-ol me-2"></i>Add Doctor</a>
            </div>
        </div>
      </div>
       <div class="card">
        <div class="card-header">
          <h3>Doctor List</h3>
        </div>
        <div class="card-body">
          <div class="customer-table">
            <div class="table-responsive white-space-nowrap">
               <table class="table align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Doctor ID</th>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Available Slots</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "hospital_management");

                // Fetch doctors
                $query = "SELECT * FROM doctors";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . $row['doctor_id'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['specialization'] . "</td>
                            <td>" . $row['available_slots'] . "</td>
                            <td>
                              <a href='edit_doctor.php?id=" . $row['doctor_id'] . "' class='btn btn-info'>Edit</a>
                              <form method='POST' action='delete_doctor.php' onsubmit='return confirm(\"Are you sure you want to delete this doctor?\")'>
                                <input type='hidden' name='doctor_id' value='" . $row['doctor_id'] . "'>
                                <button type='submit' class='btn btn-danger'>Delete</button>
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