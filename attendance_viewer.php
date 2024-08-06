<!DOCTYPE html>
<html>
<head>
  <title>Attendance Viewer</title>
  <style>
    /* Basic styling for the navigation link */
    li {
      list-style: none; /* Remove default list styling */
    }

    a {
      text-decoration: none; /* Remove underline from links */
      color: #333; /* Set link color */
      padding: 10px 15px; /* Add padding to the link */
      display: inline-block; /* Display links as inline-block for better spacing */
      transition: color 0.3s ease; /* Add a smooth color transition on hover */
    }

    /* Change link color on hover */
    a:hover {
      color: #007bff; /* Change color to a different shade on hover */
    }

    .container {
      width: 400px;
      margin: 0 auto;
      padding: 20px;
      text-align: center;
    }

    h1 {
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    input[type="submit"],
    input[type="button"] {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    input[type="submit"]:hover,
    input[type="button"]:hover {
      background-color: #45a049;
    }

    input[type="date"] {
      padding: 8px;
      width: 200px;
    }
    body {
      background: url('new.jpg') center/cover no-repeat;
    }
  </style>
</head>
<li><a href="adminhome.php">DASHBOARD</a></li>
<body>
  <?php
  // Database connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "office";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['view_attendance'])) {
    $selectedDate = $_POST['date'];

    // Query to get attendance records for the selected date
    $attendanceQuery = "SELECT register.e_id, register.uname, attendance.status 
                        FROM register 
                        LEFT JOIN attendance 
                        ON register.e_id = attendance.employee_id AND attendance.date = '$selectedDate'";
    $attendanceResult = $conn->query($attendanceQuery);

    if ($attendanceResult->num_rows > 0) {
      echo "<div class='container'>";
      echo "<h1>Attendance for Date: $selectedDate</h1>";
      echo "<table>";
      echo "<tr><th>Employee ID</th><th>Employee Name</th><th>Attendance Status</th></tr>";

      while ($row = $attendanceResult->fetch_assoc()) {
        $employeeId = $row["e_id"];
        $employeeName = $row["uname"];
        $attendanceStatus = $row["status"];

        echo "<tr>";
        echo "<td>$employeeId</td>";
        echo "<td>$employeeName</td>";
        echo "<td>$attendanceStatus</td>";
        echo "</tr>";
      }

      echo "</table>";
      echo "</div>";
    } else {
      echo "<div class='container'>";
      echo "No attendance found for the selected date.";
      echo "</div>";
    }
  }
  ?>

  <div class="container">
    <h1>Attendance Viewer</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <h2>View Attendance for Date:</h2>
      <input type="date" name="date" required>
      <input type="submit" name="view_attendance" value="View Attendance">
    </form>
  </div>

</body>
</html>
