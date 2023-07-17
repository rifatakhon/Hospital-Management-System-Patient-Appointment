<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>
<?php
$conn = mysqli_connect("localhost", "root", "", "hospital_management");
              // Retrieve the patient details for the specified patient ID
              if (isset($_GET["patient_id"])) {
                  $patient_id = $_GET["patient_id"];

                  $query = "SELECT * FROM patients WHERE patient_id = $patient_id";
                  $result = mysqli_query($conn, $query);
                  $patient = mysqli_fetch_assoc($result);
              }

              mysqli_close($conn);

              // Display the doctor edit form
              ?>


    <!--start main content-->
     <main class="page-content">

      <div class="row">
        <div class="col-auto">
          <div class="d-flex align-items-center gap-2 justify-content-lg-end">
               <a class="btn btn-primary px-4" href="patient_list.php"><i class="bi bi-list-ol me-2"></i>Patient List</a>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 m-auto">
          <div class="card">
            <div class="card-header">
              <h3>Edit Patient</h3>
            </div>
            <div class="card-body">
              <form method="POST" action="update_patient_process.php">
                <input type="hidden" name="patient_id" value="<?php echo $patient['patient_id']; ?>">
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?php echo $patient['name']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="text" class="form-control" id="email" name="email" value="<?php echo $patient['email']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="phone">Phone:</label>
                  <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $patient['phone']; ?>" required>
                </div>
                <div class="form-group mb-2">
                  <label for="address">Address:</label>
                  <input type="text" class="form-control" id="address" name="address" value="<?php echo $patient['address']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Patient</button>
              </form>
            </div>
          </div>
        </div>
      </div>

        
     </main>
     <!--end main content-->
     <?php include 'include/footer.php' ?>