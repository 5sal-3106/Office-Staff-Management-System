<!DOCTYPE html>
<html>
<head>
  <title>Attendance Management System</title>
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

    input[type="text"] {
      padding: 8px;
      width: 150px;
    }
    body {
      background: url('new.jpg') center/cover no-repeat;
    }
  </style>
</head>
<body>
<li><a href="adminhome.php">DASHBOARD</a></li>
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

  // Attendance submission
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['attendance'])) {
      $attendanceData = $_POST['attendance'];

      // Get current date and time
      $dateString = date('Y-m-d');
      $timeString = date('H:i:s');

      foreach ($attendanceData as $employeeId => $status) {
        $employeeId = $conn->real_escape_string($employeeId);
        $attendanceStatus = $conn->real_escape_string($status);

        // Check if attendance is already taken for the selected date
        $checkAttendanceQuery = "SELECT * FROM attendance WHERE date = '$dateString' AND employee_id = '$employeeId'";
        $checkAttendanceResult = $conn->query($checkAttendanceQuery);

        if ($checkAttendanceResult->num_rows === 0) {
          // Assign 1 and 0 for attendance percentage
          $attendancePercentage = ($attendanceStatus == 'Present') ? 100 : 0;

          // Insert attendance data into the database table
          $sql = "INSERT INTO attendance (date, time, employee_id, status, attendance_percentage) VALUES ('$dateString', '$timeString', '$employeeId', '$attendanceStatus', $attendancePercentage)";

          if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
      }

      echo "Attendance taken successfully.";
    }
  }

  // Check if the attendance date is chosen
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['view_attendance'])) {
    $selectedDate = $_POST['date'];

    // Query to get attendance records for the selected date
    $attendanceQuery = "SELECT register.e_id, register.uname, attendance.status 
                        FROM register 
                        LEFT JOIN attendance 
                        ON register.e_id = attendance.employee_id AND attendance.date = '$selectedDate'";
    $attendanceResult = $conn->query($attendanceQuery);

    if ($attendanceResult->num_rows > 0) {
      echo "<h2>Attendance for Date: $selectedDate</h2>";
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
    } else {
      echo "No attendance found for the selected date.";
    }
  }

  // Search functionality
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $searchId = $_POST['search'];
    $searchQuery = "SELECT e_id, uname FROM register WHERE e_id = '$searchId'";
    $result = $conn->query($searchQuery);
  } else {
    // Fetch employees from the database table
    $sql = "SELECT e_id, uname FROM register";
    $result = $conn->query($sql);
  }

  // Check if attendance is already taken for the current date
  $currentDate = date('Y-m-d');
  $checkAttendanceQuery = "SELECT * FROM attendance WHERE date = '$currentDate'";
  $checkAttendanceResult = $conn->query($checkAttendanceQuery);

  if ($checkAttendanceResult->num_rows === 0) {
    ?>

    <div class="container">
      <h1>Attendance Management System</h1>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="search" placeholder="Search Employee ID">
        <input type="submit" value="Search">
      </form>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
          <tr>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Attendance Status</th>
          </tr>
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $employeeId = $row["e_id"];
              $employeeName = $row["uname"];
              echo '<tr>';
              echo '<td>' . $employeeId . '</td>';
              echo '<td>' . $employeeName . '</td>';
              echo '<td>';
              echo '<select name="attendance[' . $employeeId . ']">';
              echo '<option value="Present">Present</option>';
              echo '<option value="Absent">Absent</option>';
              echo '</select>';
              echo '</td>';
              echo '</tr>';
            }
          }
          ?>
        </table>
        <input type="submit" value="Submit Attendance">
      </form>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h2>View Attendance for Date:</h2>
        <input type="date" name="date" required>
        <input type="submit" name="view_attendance" value="View Attendance">
      </form>
    </div>

    <?php
  } else {
    echo "Attendance has already been taken for today.";
  }
  ?>

</body>
</html>
