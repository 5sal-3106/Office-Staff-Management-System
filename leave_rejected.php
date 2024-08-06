<?php include 'dashboard.php';
$get_id = $_GET['id'];?>
<?php 
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "office";
    $conn       = mysqli_connect($servername,$username,$password,$dbname);
    $query = "update leaves set status = 'Rejected' where l_id = '$get_id'";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        echo "<script>alert('Leave rejected Successfully');</script>";
        echo "<script type='text/javascript'> document.location = 'view_leave.php'; </script>";
      }
      else
      {
        echo "Error updating task: " . mysqli_error($conn);
      }
?>