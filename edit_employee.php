<?php
include 'dashboard.php';
$get_id = $_GET['id'];
error_reporting(E_ALL); // show all errors

if(isset($_POST['edit_employee']))
{
  $id           = $_POST['id'];
  $Full_Name    = $_POST['Full_Name'];
  $User_Name    = $_POST['User_Name'];
  $Email        = $_POST['Email'];
  $Phone_Number = $_POST['Phone_Number'];
  $Gender       = $_POST['gender'];

  $servername  = "localhost";
  $username    = "root";
  $password    = "";
  $dbname      = "office";
  $conn        = mysqli_connect($servername, $username, $password, $dbname);

  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $query = "UPDATE register SET fname='$Full_Name', uname='$User_Name', email='$Email', phno='$Phone_Number', gender='$Gender' WHERE e_id='$get_id'";

  $result = mysqli_query($conn, $query);

  if($result)
  {
    echo "<script>alert('Employee Details updated Successfully');</script>";
    echo "<script type='text/javascript'> document.location = 'view_employee.php'; </script>";
  }
  else
  {
    echo "Error updating task: " . mysqli_error($conn);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit employee details</title>
</head>
<body>
<main class="main-container" id="main">
  <div class="main-title">
    <h2>Edit employee details</h2>
  </div>
  <?php
  $servername = "localhost";
  $username   = "root";
  $password   = "";
  $dbname     = "office";
  $conn       = mysqli_connect($servername, $username, $password, $dbname);

  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $query = mysqli_query($conn, "SELECT * from register where e_id = '$get_id'") or die(mysqli_error($conn));
  $row = mysqli_fetch_array($query);
  ?>
  <form action="" method="POST">
    <div class="form-group">
    <input type="hidden" name="id" class="form-control" value="<?php echo $get_id ?>" required>
    </div>
    <div class="user-details">
    <div class="input-box">
        <span class="details">Full Name</span>
        <input type="text" name="Full_Name" autocomplete="off" value="<?php echo isset($row['fname']) ? $row['fname'] : ''; ?>" required>
    </div>
    <br>
    <div class="input-box">
        <span class="details">User Name</span>
        <input type="text" name="User_Name" autocomplete="off" value="<?php echo isset($row['uname']) ? $row['uname'] : ''; ?>" required>
    </div>
    <br>
    <div class="input-box">
        <span class="details">Email</span>
        <input type="email" name="Email" autocomplete="off" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" required>
    </div>
    <br>
    <div class="input-box">
        <span class="details">Phone Number</span>
        <input type="tel" pattern="[0-9]{10}" name="Phone_Number" value="<?php echo isset($row['phno']) ? $row['phno'] : ''; ?>" required>
    </div>
    <br>
    <div class="input-box">
        <span class="details">Gender</span>
        <select name="gender">
            <option value="Male" <?php echo (isset($row['gender']) && $row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo (isset($row['gender']) && $row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
        </select>
    </div>
    <br>
    <input class="btn btn-warning" type="Submit"  value="UPDATE" name="edit_employee"  id="edit_employee">
  </form>
</body>
</html>
