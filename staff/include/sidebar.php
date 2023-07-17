<!--start sidebar-->
      <aside class="sidebar-wrapper">
          <div class="sidebar-header">
            <div class="logo-icon">
              <img src="assets/images/logo-icon.png" class="logo-img" alt="">
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
                  <a href="dashboard.php">
                    <div class="parent-icon"><span class="material-symbols-outlined">home</span>
                    </div>
                    <div class="menu-title">Dashboard</div>
                  </a>
                </li>
                <li class="menu-label">Appointment Info</li>
                <li>
                  <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><span class="material-symbols-outlined">widgets</span>
                    </div>
                    <div class="menu-title">Appointment</div>
                  </a>
                  <ul>
                    <li> <a href="pending_appointment_list.php"><span class="material-symbols-outlined">arrow_right</span>Pending Appointment List</a>
                    </li>
                    <li> <a href="appointment_list.php"><span class="material-symbols-outlined">arrow_right</span>Approved Appointment List</a>
                    </li>
                  </ul>
                </li>
                <li class="menu-label">Patient Info</li>
                <li>
                  <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><span class="material-symbols-outlined">widgets</span>
                    </div>
                    <div class="menu-title">Paitents</div>  
                  </a>
                  <ul>
                    <li> <a href="patient_list.php"><span class="material-symbols-outlined">arrow_right</span>Patient List</a>
                    </li>
                  </ul>
                </li>
                <li class="menu-label">Doctor Info</li>
                <li>
                  <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><span class="material-symbols-outlined">widgets</span>
                    </div>
                    <div class="menu-title">Doctors</div>
                  </a>
                  <ul>
                    <li> <a href="add_doctor.php"><span class="material-symbols-outlined">arrow_right</span>Add Doctor</a>
                    </li>
                    <li> <a href="doctor_list.php"><span class="material-symbols-outlined">arrow_right</span>Doctor List</a>
                    </li>
                  </ul>
                </li>
              </ul>
              <!--end navigation-->

              
          </div>
          <div class="sidebar-bottom dropdown dropup-center dropup">
              <div class="dropdown-toggle d-flex align-items-center px-3 gap-3 w-100 h-100" data-bs-toggle="dropdown">
                <div class="user-img">
                   <img src="assets/images/avatars/01.png" alt="">
                </div>
                <div class="user-info">
                  <h5 class="mb-0 user-name">Orni Natasha</h5>
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