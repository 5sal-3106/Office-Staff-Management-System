<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["Email"])) {
  header("location: adminlogin.html");
}

// Establish a database connection
$connection = mysqli_connect("localhost", "root", "", "office");

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the actual task count from the database
$query = "SELECT COUNT(*) AS taskCount FROM tasks";
$result = mysqli_query($connection, $query);
$taskCount = ($result) ? mysqli_fetch_assoc($result)['taskCount'] : 0;

// Fetch the actual leave count from the database
$query = "SELECT COUNT(*) AS leaveCount FROM leaves";
$result = mysqli_query($connection, $query);
$leaveCount = ($result) ? mysqli_fetch_assoc($result)['leaveCount'] : 0;

// Fetch the actual attendance percentage from the database
$query = "SELECT AVG(attendance_percentage) AS attendancePercentage FROM attendance";
$result = mysqli_query($connection, $query);
$attendancePercentage = ($result) ? round(mysqli_fetch_assoc($result)['attendancePercentage']) . '%' : '0%';




// Fetch the actual employee count from the database
$query = "SELECT COUNT(*) AS employeeCount FROM register";
$result = mysqli_query($connection, $query);
$employeeCount = ($result) ? mysqli_fetch_assoc($result)['employeeCount'] : 0;

// Close the database connection
mysqli_close($connection);
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
  <link rel="stylesheet" type="text/css" href="adminhome.css">


  <!-- Jquery code -->
</head>
<body>
  <div class="grid-container">
    <!-- Header -->
    <header class="header">
      <div class="menu-icon" onclick="openSidebar()">
        <span class="material-icons-outlined">menu</span>
      </div>
      <div class="header-right">
        <h1>HELLO <?php echo $_SESSION["Email"]; ?></h1>
      </div>
      
    </header>
    <!-- End Header -->

     <!-- Sidebar -->
     <aside id="sidebar">
        <div class="sidebar-title">
          <div class="logo">
            <img src="logo.png" alt="">
          </div>
          
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="adminhome.php" >
              <span class="material-icons-outlined">dashboard</span> Dashboard
            </a>
          </li>
          <li class="sidebar-list-item">
          <a href="create_task.php">
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
            <a href="attendance_viewer.php" >
              <span class="material-icons-outlined">co_present</span>view attendance
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="manage_attendance.php" >
              <span class="material-icons-outlined">co_present</span>Manage Atten.
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

    <!-- Main -->
    <main class="main-container" id="main">
      <div class="main-title">
        <h2>DASHBOARD</h2>
      </div>

      <script src="js/scripts.js"></script>
    </body>
    </html>
