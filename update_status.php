<?php
include 'edashboard.php';
$get_id = $_GET['id'];
error_reporting(E_ALL); // show all errors

if(isset($_POST['UPDATE']))
{

  $servername  = "localhost";
  $username    = "root";
  $password    = "";
  $dbname      = "office";
  $conn        = mysqli_connect($servername, $username, $password, $dbname);

  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $query = "UPDATE tasks SET status='".$_POST['status']."' WHERE t_id='$get_id'";


  $result = mysqli_query($conn, $query);

  if($result)
  {
    echo "<script>alert('Status updated Successfully');</script>";
    echo "<script type='text/javascript'> document.location = 'empupdate.php'; </script>";
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
    <title>Edit Task</title>
    <style>
        form {
  max-width: 500px;
  margin: auto;
  padding: 20px;
  background: #fff;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  font-size: 18px;
  margin-bottom: 5px;
}

.form-control {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

select.form-control {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%231a1a1a' d='M2 5L0 2h4l-2 3z'/%3E%3C/svg%3E") no-repeat;
  background-size: 10px 7px;
  background-position: right 10px center;
  padding-right: 30px;
}

input[type="submit"] {
  display: block;
  width: 100%;
  padding: 10px;
  font-size: 16px;
  background: #ffc107;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background: #ff9800;
}

    </style>
</head>
<body>
<main class="main-container" id="main">
  <div class="main-title">
    <h2>UPDATE TASk</h2>
  </div>
  <?php
  $servername = "localhost";
  $username   = "root";
  $password   = "";
  $dbname     = "office";
  $conn       = mysqli_connect($servername,$username,$password,$dbname);

  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $query = mysqli_query($conn,"SELECT * from tasks where t_id = '$get_id'")or die(mysqli_error());
  $row = mysqli_fetch_array($query);
  ?>
  <form action="" method="POST">
    <div class="form-group">
    <input type="hidden" name="id" class="form-control" value="<?php echo $get_id ?>" required>
    </div>
    
    <div class="form-group">
        <select class=form-control name="status" >
            <option>-select-</option>
            <option>In-progress</option>
            <option>completed</option>
        </select>
    </div>
    <input class="btn btn-warning" type="Submit"  value="UPDATE" name="UPDATE"  id="UPDATE">
   
   
  </form>
</body>
</html>  


