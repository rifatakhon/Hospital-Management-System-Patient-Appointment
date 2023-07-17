<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>
<?php
              $doctor_id = $_GET['id']; // Get the doctor ID from the URL parameter

              $conn = mysqli_connect("localhost", "root", "", "hospital_management");

              // Fetch doctor details from the database based on the doctor ID
              $query = "SELECT * FROM doctors WHERE doctor_id = $doctor_id";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);

              // Display the doctor edit form
              ?>


    <!--start main content-->
     <main class="page-content">

      <div class="row">
        <div class="col-auto">
          <div class="d-flex align-items-center gap-2 justify-content-lg-end">
               <button class="btn btn-primary px-4"><i class="bi bi-list-ol me-2"></i>Doctor List</button>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 m-auto">
          <div class="card">
            <div class="card-header">
              <h3>Edit Doctor</h3>
            </div>
            <div class="card-body">
              <form method="POST" action="update_doctor.php">
                <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="specialization">Specialization:</label>
                  <input type="text" class="form-control" id="specialization" name="specialization" value="<?php echo $row['specialization']; ?>" required>
                </div>
                <div class="form-group mb-2">
                  <label for="available_slots">Available Slots:</label>
                  <input type="number" class="form-control" id="available_slots" name="available_slots" value="<?php echo $row['available_slots']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Doctor</button>
              </form>
            </div>
          </div>
        </div>
      </div>

        
     </main>
     <!--end main content-->
     <?php include 'include/footer.php' ?>