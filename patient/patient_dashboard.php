<?php
session_start();
if (!isset($_SESSION["patient_email"])) {
    header("Location: login.php");
    exit();
}

// Get the patient's email from the session
$patient_email = $_SESSION["patient_email"];

// Fetch patient details from the database
$conn = mysqli_connect("localhost", "root", "", "hospital_management");
$query = "SELECT * FROM patients WHERE email = '$patient_email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Fetch patient's appointments and join with doctors
$query = "SELECT appointments.appointment_id, doctors.name AS doctor_name, appointments.appointment_date, appointments.appointment_time, appointments.approval_status
FROM appointments
JOIN doctors ON appointments.doctor_id = doctors.doctor_id
WHERE appointments.patient_id = " . $row['patient_id'];
$appointments_result = mysqli_query($conn, $query);

mysqli_close($conn);
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient Dashboard - Hospital Management System</title>

    <!--plugins-->
    <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" >
    <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet">
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet">
    <!-- loader-->
	  <link href="../assets/css/pace.min.css" rel="stylesheet">
	  <script src="../assets/js/pace.min.js"></script>
    <!--Styles-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/icons.css" >

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="../assets/css/dark-theme.css" rel="stylesheet">
    <link href="../assets/css/semi-dark-theme.css" rel="stylesheet">
    <link href="../assets/css/minimal-theme.css" rel="stylesheet">
    <link href="../assets/css/shadow-theme.css" rel="stylesheet">
     
  </head>
  <body>

    <!--start header-->
     <header class="top-header">
      <nav class="navbar navbar-expand justify-content-between">
          <div class="btn-toggle-menu">
            <span class="material-symbols-outlined">menu</span>
          </div>
       </nav>
     </header>
     <!--end header-->


     <!--start sidebar-->
      <aside class="sidebar-wrapper">
          <div class="sidebar-header">
            <div class="logo-icon">
              <img src="../assets/images/logo-icon.png" class="logo-img" alt="">
            </div>
            <div class="logo-name flex-grow-1">
              <h5 class="mb-0">X Hospital</h5>
            </div>
            <div class="sidebar-close ">
              <span class="material-symbols-outlined">close</span>
            </div>
          </div>
          <div class="sidebar-nav" data-simplebar="true">
            
              <!--navigation-->
              <ul class="metismenu" id="menu">
                <li>
                  <a href="index.html">
                    <div class="parent-icon"><span class="material-symbols-outlined">home</span>
                    </div>
                    <div class="menu-title">Dashboard</div>
                  </a>
                </li>
              </ul>
              <!--end navigation-->

              
          </div>
          <div class="sidebar-bottom dropdown dropup-center dropup">
              <div class="dropdown-toggle d-flex align-items-center px-3 gap-3 w-100 h-100" data-bs-toggle="dropdown">
                <div class="user-img">
                   <img src="../assets/images/avatars/01.png" alt="">
                </div>
                <div class="user-info">
                  <h5 class="mb-0 user-name"><?=$_SESSION['patient_name']?></h5>
                </div>
              </div>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="logout.php"><span class="material-symbols-outlined me-2">
                  logout
                  </span><span>Logout</span></a>
                </li>
              </ul>
          </div>
     </aside>
     <!--end sidebar-->


    <!--start main content-->
     <main class="page-content">
      <h2>Patient Dashboard</h2>
<div class="card border-bottom border-0 border-4 shadow-sm border-success">
              <div class="card-body text-center">
                <div class="mt-4">
                    <h5 class="mb-1"><?php echo $row['name']; ?></h5>
                </div>
                <div class="d-flex align-items-center justify-content-around mt-4">
                  <div class="">
                    <h5 class="mb-0 fw-bold">Email</h5>
                    <p class="mb-0"><?php echo $row['email']; ?></p>
                  </div>
                  <div class="">
                    <h5 class="mb-0 fw-bold">Phone</h5>
                    <p class="mb-0"><?php echo $row['phone']; ?></p>
                  </div>
                  <div class="">
                    <h5 class="mb-0 fw-bold">Address</h5>
                    <p class="mb-0"><?php echo $row['address']; ?></p>
                  </div>
               </div>
              </div>
            </div>
      
      


       <div class="card">
        <div class="card-header">
          <h3>My Appointments</h3>
        </div>
        <div class="card-body">
          <div class="customer-table">
            <div class="table-responsive white-space-nowrap">
               <table class="table align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Appointment ID</th>
                    <th>Doctor Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                  </tr>
                 </thead>
                 <tbody>
                  <?php
        while ($appointment_row = mysqli_fetch_assoc($appointments_result)) {
            echo "<tr>
                    <td>" . $appointment_row['appointment_id'] . "</td>
                    <td>" . $appointment_row['doctor_name'] . "</td>
                    <td>" . $appointment_row['appointment_date'] . "</td>
                    <td>" . $appointment_row['appointment_time'] . "</td>
                    <td>" . $appointment_row['approval_status'] . "</td>
                  </tr>";
        }
        ?>

                   
                 </tbody>
               </table>
            </div>
          </div>
        </div>
      </div>

        
     </main>
     <!--end main content-->
 

    <!--start overlay-->
      <div class="overlay btn-toggle-menu"></div>
    <!--end overlay-->

   


    <!--start theme customization-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="ThemeCustomizer" aria-labelledby="ThemeCustomizerLable">
      <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="ThemeCustomizerLable">Theme Customizer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <h6 class="mb-0">Theme Variation</h6>
        <hr>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme" value="option1">
          <label class="form-check-label" for="LightTheme">Light</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme" value="option2" checked="">
          <label class="form-check-label" for="DarkTheme">Dark</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDarkTheme" value="option3">
          <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
        </div>
        <hr>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="MinimalTheme" value="option3">
          <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="ShadowTheme" value="option4">
          <label class="form-check-label" for="ShadowTheme">Shadow Theme</label>
        </div>
       
      </div>
    </div>
    <!--end theme customization-->


   <!--plugins-->
   <script src="../assets/js/jquery.min.js"></script>
   <script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
   <script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
   <script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
   <script src="../assets/plugins/apex/apexcharts.min.js"></script>
   <script src="../assets/js/index.js"></script>
    <!--BS Scripts-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
  </body>
</html>