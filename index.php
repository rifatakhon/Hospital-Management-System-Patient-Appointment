<?php
session_start();

?>
<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home - Hospital Management System</title>

  <!--plugins-->
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet">
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet">
  <!--Styles-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/icons.css">

  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/dark-theme.css" rel="stylesheet">

</head>

<body>


  <!--authentication-->

  <div class="mx-3 mx-lg-0">

  <div class="card my-5 col-xl-9 col-xxl-8 mx-auto rounded-4 overflow-hidden border-3 p-3">
    <div class="row g-3">
      <div class="col-lg-6 d-flex">
        <div class="card-body p-5 w-100">
          <img src="assets/images/logo-icon.png" class="mb-4" width="45" alt="">
          <h4 class="fw-bold">Book An Appointment</h4>
          <p class="mb-0">Enter your credentials to creat your account</p>
          <div class="separator">
            <div class="line"></div>
            <p class="mb-0 fw-bold">For Patient Only</p>
            <div class="line"></div>
          </div>
          <!-- Check if a flash message exists and display it -->
          <?php if (isset($_SESSION["flash_message"])): ?>
            <div class="alert alert-success">
              <?php echo $_SESSION["flash_message"]; ?>
            </div>
            <?php unset($_SESSION["flash_message"]); ?>
          <?php endif; ?>
          <div class="form-body mt-4">
            <form class="row g-3" method="POST" action="action/appointment_process.php">
              <div class="col-12">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Lal Mia" required>
              </div>
              <div class="col-12">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@user.com" required>
              </div>
              <div class="col-12">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="01XXXXXXXXX" required>
              </div>
              <div class="col-12">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="522/1, Shahjahanpur, Dhaka-1214" required>
              </div>
              <div class="col-12">
                <label for="doctor" class="form-label">Select Doctor</label>
                <select class="form-select" id="doctor" name="doctor" required>
                  <option selected="">----- Select One -----</option>
                  <?php
                    // Fetch doctors from the database
                    $conn = mysqli_connect("localhost", "root", "", "hospital_management");
                    $query = "SELECT * FROM doctors";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<option value='" . $row['doctor_id'] . "'>" . $row['name'] . " - " . $row['specialization'] . "</option>";
                    }

                    mysqli_close($conn);
                  ?>
                </select>
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary">Register</button>
                </div>
              </div>
              <div class="col-12">
                <div class="text-start">
                  <p class="mb-0">Already have an Appointment? <a href="patient/index.php">Sign in here</a></p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6 d-lg-flex d-none">
        <div class="p-3 rounded-4 w-100 d-flex align-items-center justify-content-center border-3 bg-primary">
          <img src="assets/images/appointment.png" class="img-fluid rounded-4" alt="">
        </div>
        
      </div>
    </div><!--end row-->
  </div>

</div>

<!--authentication-->




  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>

</body>

</html>