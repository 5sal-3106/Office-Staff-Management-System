<?php
session_start();

if (!isset($_SESSION["Email"])) {
    header("location:emplogin.html");
}

// Establish a database connection
$connection = mysqli_connect("localhost", "root", "", "office");

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Replace {e_id} with the actual employee ID
$employee_id = $_SESSION["e_id"]; // Retrieve the employee ID from the session

// Fetch the actual task count from the database
$query = "SELECT COUNT(*) AS taskCount FROM tasks WHERE e_id = $employee_id";
$result = mysqli_query($connection, $query);
$taskCount = ($result) ? mysqli_fetch_assoc($result)['taskCount'] : 0;

// Fetch the actual leave count from the database
$query = "SELECT COUNT(*) AS leaveCount FROM leaves WHERE e_id = $employee_id";
$result = mysqli_query($connection, $query);
$leaveCount = ($result) ? mysqli_fetch_assoc($result)['leaveCount'] : 0;

// Fetch the actual attendance percentage from the database
$query = "SELECT AVG(attendance_percentage) AS attendancePercentage FROM attendance WHERE employee_id = $employee_id";
$result = mysqli_query($connection, $query);
$attendancePercentage = ($result) ? round(mysqli_fetch_assoc($result)['attendancePercentage']) . '%' : '0%';

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>

    <!-- Poppins Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">

    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="emphomee.css">
</head>
<body>
    <div class="grid-container">

        <!-- Header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-right">
                <h1>HELLO <?php echo $_SESSION["Email"]; ?> </h1>
            </div>
            <div class="header-right">
                <span class="material-icons-outlined">notifications</span>
                <span class="material-icons-outlined">account_circle</span>
            </div>
        </header>
        <!-- End Header -->

        <!-- Top Navigation -->
        <nav class="top-nav">
            <ul class="nav-list">
                <li class="nav-list-item">
                    <a href="emphome.php">
                        <span class="material-icons-outlined">dashboard</span> Dashboard
                    </a>
                </li>
                <li class="nav-list-item">
                    <a href="empupdate.php">
                        <span class="material-icons-outlined">add_task</span> Update Task
                    </a>
                </li>
                <li class="nav-list-item">
                    <a href="empleave.php">
                        <span class="material-icons-outlined">task</span> Apply Leave
                    </a>
                </li>
                <li class="nav-list-item">
                    <a href="empleave_status.php">
                        <span class="material-icons-outlined">holiday_village</span> Leave Status
                    </a>
                </li>
                <li class="nav-list-item">
                    <a href="emp_attendance.php">
                        <span class="material-icons-outlined">co_present</span> Attendance
                    </a>
                </li>
                <li class="nav-list-item">
                    <a href="emplogout.php">
                        <span class="material-icons-outlined">logout</span> Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Top Navigation -->

        <!-- Main -->
        <main class="main-container">
            <div class="main-title">
                <h2>DASHBOARD</h2>
            </div>

            <div class="main-content">
                <ul class="info-list">
                    <li><strong>Task Count:</strong> <?php echo $taskCount; ?></li>
                    <li><strong>Leave Count:</strong> <?php echo $leaveCount; ?></li>
                    <li><strong>Attendance Percentage:</strong> <?php echo $attendancePercentage; ?></li>
                </ul>
            </div>
        </main>
        <!-- End Main -->

    </div>
    <script src="js/scripts.js"></script>
</body>
</html>
