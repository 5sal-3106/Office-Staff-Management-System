<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Attendance Management</title>
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

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      text-align: center;
      margin-top: 20px;
    }

    form {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="submit"],
    select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 3px;
      margin-bottom: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    input[type="submit"] {
      background-color: #4caf50;
      color: #fff;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .error {
      color: #f00;
      font-weight: bold;
      margin-bottom: 10px;
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
  $attendanceData = $_POST['attendance'];

  // Get current date and time
  $dateString = date('Y-m-d');
  $timeString = date('H:i:s');

  foreach ($attendanceData as $employeeId => $status) {
    $employeeId = $conn->real_escape_string($employeeId);
    $attendanceStatus = $conn->real_escape_string($status);

    // Check if a record already exists for the employee on the given date
    $existingRecordQuery = "SELECT * FROM attendance WHERE date = '$dateString' AND employee_id = '$employeeId'";
    $existingRecordResult = $conn->query($existingRecordQuery);

    if ($existingRecordResult->num_rows > 0) {
      // Update the existing record
      $updateQuery = "UPDATE attendance SET time = '$timeString', status = '$attendanceStatus' WHERE date = '$dateString' AND employee_id = '$employeeId'";

      if ($conn->query($updateQuery) !== TRUE) {
        echo "Error updating record: " . $conn->error;
      }
    } else {
      // Insert a new record
      $insertQuery = "INSERT INTO attendance (date, time, employee_id, status) VALUES ('$dateString', '$timeString', '$employeeId', '$attendanceStatus')";

      if ($conn->query($insertQuery) !== TRUE) {
        echo "Error inserting record: " . $conn->error;
      }
    }
  }

  echo "<script>alert('Attendance Recorded Successfully');</script>";
}

// Search functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
  $searchId = $_POST['search'];
  $searchQuery = "SELECT r.e_id, r.uname, a.status 
                  FROM register r 
                  LEFT JOIN attendance a ON r.e_id = a.employee_id AND a.date = CURDATE()
                  WHERE r.e_id = '$searchId'";
  $result = $conn->query($searchQuery);
} else {
  // Fetch employees and their attendance status from the database table
  $sql = "SELECT r.e_id, r.uname, a.status 
          FROM register r 
          LEFT JOIN attendance a ON r.e_id = a.employee_id AND a.date = CURDATE()";
  $result = $conn->query($sql);
}
?>


<!-- Search Bar -->




<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <label for="search">Search Employee ID:</label>
  <input type="text" id="search" name="search">
  <input type="submit" value="Search">
</form>

<!-- Display Attendance Records -->


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
        $attendanceStatus = $row["status"];
        echo '<tr>';
        echo '<td>' . $employeeId . '</td>';
        echo '<td>' . $employeeName . '</td>';
        echo '<td>';
        echo '<select name="attendance[' . $employeeId . ']">';
        echo '<option value="Present" ' . ($attendanceStatus === 'Present' ? 'selected' : '') . '>Present</option>';
        echo '<option value="Absent" ' . ($attendanceStatus === 'Absent' ? 'selected' : '') . '>Absent</option>';
        echo '</select>';
        echo '</td>';
        echo '</tr>';
      }
    }

    $conn->close();
    ?>
  </table>
  <input type="submit" value="Submit Attendance">
</form>

</body>
</html>
