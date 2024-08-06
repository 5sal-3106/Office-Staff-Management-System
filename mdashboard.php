<?php 

session_start();


if(!isset($_SESSION["Email"]))
{
    header("location:adminlogin.html");
}


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    
    
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/mdashboard.css">
    
    
    
  
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-right">
         <h1>HELLO <?php echo $_SESSION["Email"] ?> </h1>
        </div>
        <div class="header-right">
          <span class="material-icons-outlined">account_circle</span>
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="logo">
            <img src="logo.png" alt="">
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="adminhome.php" >
              <span class="material-icons-outlined">dashboard</span> Dashboard
            </a>
          </li>
          <li class="sidebar-list-item">
          <a href="create_task.php ">
              <span class="material-icons-outlined">add_task</span> Create Task
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="manage_task.php" >
              <span class="material-icons-outlined">task</span> Manage Task
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="register.html" >
              <span class="material-icons-outlined">co_present</span> Add Employee
            </a>
          <li class="sidebar-list-item">
            <a href="view_leave.php" >
              <span class="material-icons-outlined">holiday_village</span> Leaves
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="view_employee.php" >
              <span class="material-icons-outlined">work</span> View Employee
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="attendance.php" >
              <span class="material-icons-outlined">co_present</span> Attandance
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="manage_attendance.php" >
              <span class="material-icons-outlined">co_present</span> Manage Atten
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="adminlogout.php" >
              <span class="material-icons-outlined">logout</span> Logout
            </a>
          </li>
        </ul>
      </aside>
      <!-- End Sidebar -->
      <script src="js/scripts.js">
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
      </script>
      
    </body>
    </html>
