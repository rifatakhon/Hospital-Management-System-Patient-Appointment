<?php include 'include/header.php' ?>
<?php include 'include/sidebar.php' ?>



    <!--start main content-->
     <main class="page-content">

      <div class="row">
        <div class="col-auto">
          <div class="d-flex align-items-center gap-2 justify-content-lg-end">
               <a class="btn btn-primary px-4" href="doctor_list.php"><i class="bi bi-list-ol me-2"></i>Doctor List</a>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 m-auto">
          <div class="card">
            <div class="card-header">
              <h3>Add Doctor</h3>
            </div>
            <div class="card-body">
              <form method="POST" action="save_doctor.php">
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="form-group">
                <label for="specialization">Specialization:</label>
                <input type="text" class="form-control" id="specialization" name="specialization" required>
              </div>
              <div class="form-group mb-2">
                <label for="available_slots">Available Slots:</label>
                <input type="number" class="form-control" id="available_slots" name="available_slots" required>
              </div>
              <button type="submit" class="btn btn-primary">Add Doctor</button>
            </form>
            </div>
          </div>
        </div>
      </div>

        
     </main>
     <!--end main content-->
     <?php include 'include/footer.php' ?>