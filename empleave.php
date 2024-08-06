<?php 
error_reporting(0);


include 'edashboard.php'; // Includes the file edashboard.php
 // Sets error reporting to zero, to hide any error messages that might appear

if($_POST['emp_leave']){ // Checks if the form was submitted
    // Connects to the database
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "office";
    $conn = mysqli_connect($servername,$username,$password,$dbname);

    // Inserts data into the "leaves" table
    $query = "INSERT INTO leaves VALUES(null,$_SESSION[e_id],'$_POST[User_Name]','$_POST[Email]','$_POST[leave_type]','$_POST[From_date]','$_POST[To_date] ','$_POST[reason]','Not Started')";
    $data = mysqli_query($conn,$query);

    // Redirects to a confirmation page if the data was inserted successfully
    if($data){
        header("location:leave_created.php");
    } else{
        echo "failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    
    
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Global Styles */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Montserrat', sans-serif;
  font-size: 16px;
  line-height: 1.5;
}

/* Layout Styles */
.main-container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.main-title {
  margin-bottom: 20px;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}

.col-md-6 {
  width: 50%;
  float: left;
}

/* Form Styles */
.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
textarea,
select {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 16px;
  font-family: 'Montserrat', sans-serif;
  margin-bottom: 10px;
}

select {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="%23cccccc" d="M44.8 105.6L256 316.8l211.2-211.2c9.6-9.6 25.6-9.6 35.2 0 9.6 9.6 9.6 25.6 0 35.2L256 387.2 44.8 176c-9.6-9.6-9.6-25.6 0-35.2 9.6-9.6 25.6-9.6 35.2 0z"/></svg>');
  background-repeat: no-repeat;
  background-position: right center;
}

input[type="submit"] {
  background-color: #ffc107;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
}

input[type="submit"]:hover {
  background-color: #ffa000;
}

/* Responsive Styles */
@media screen and (max-width: 767px) {
  .col-md-6 {
    width: 100%;
  }
}

    </style>

    

</head>

<body>
    <main class="main-container" >
        <div class="main-title">
          <h2>APPLY LEAVE</h2>
        </div>
    <div class ="row">
        <div class="col-md-6">
            <form action="" method="post">
                <div class="form-group">
                    <label>User Name:</label>
                    <input type="text" class="form-control" placeholder="Enter your User name" name="User_Name" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" placeholder="Enter your Email" name="Email" required>
                </div>
               
                <div class="form-group">
                    <label>Leave Type:</label>
                    <select class=form-control name="leave_type" required>
                        <option>-select-</option>
                        <option>Sick Leave</option>
                        <option>Casual Leave</option>
                        <option>Personal Leave</option>
                        <option>Bereavement Leave</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>From date:</label>
                    <input type="date" class="form-control" name="From_date" required>
                </div><br>
                <div class="form-group">
                    <label>To date:</label>
                    <input type="date" class="form-control" name="To_date" required>
                </div>
                <div class="form-group">
                    <label>Reason:</label>
                    <textarea class ="form-control" rows="3" cols="50" name="reason" placeholder="Mention the Reason" required></textarea>
                </div>
                <br><br>
                <input type="Submit" class="btn btn-warning" name="emp_leave" value="Create">
            </form> 
        </div>
    </div>
</body>
</html>


