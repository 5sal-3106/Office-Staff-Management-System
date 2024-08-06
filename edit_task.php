<style>
  <style>
    /* Style for form label */
label {
    display: block; /* Display labels in block form */
    margin-bottom: 5px; /* Add some space below the label */
  }
  
  /* Style for form input fields */
  input[type="text"],
  input[type="date"],
  textarea {
    padding: 10px; /* Add some padding to input fields */
    border: 1px solid #ccc; /* Add a light gray border */
    border-radius: 4px; /* Round the corners of input fields */
    box-sizing: border-box; /* Include padding and border in input field's total width */
    margin-bottom: 10px; /* Add some space below the input field */
    width: 100%; /* Set the width of the input field to 100% of its container */
  }
  
  /* Style for select dropdown */
  select {
    padding: 10px; /* Add some padding to select dropdown */
    border: 1px solid #ccc; /* Add a light gray border */
    border-radius: 4px; /* Round the corners of select dropdown */
    box-sizing: border-box; /* Include padding and border in select dropdown's total width */
    margin-bottom: 10px; /* Add some space below the select dropdown */
    width: 100%; /* Set the width of the select dropdown to 100% of its container */
  }
  
  /* Style for submit button */
  input[type="submit"] {
    background-color: #f0ad4e; /* Set the background color of the button */
    border: none; /* Remove the border around the button */
    color: white; /* Set the text color of the button */
    padding:10px 20%; /* Add some padding to the button */
    text-align: center; /* Center align the text inside the button */
    text-decoration: none; /* Remove any text decoration (underline, etc.) */
    display: block; /* Display the button as an inline block element */
    font-size: 16px; /* Set the font size of the button */
    border-radius: 4px; /* Round the corners of the button */
    cursor: pointer; /* Change the mouse cursor to a pointer when hovering over the button */
    margin: auto;
    max-width: 80%;
  }
  
  /* Style for form group */
  .form-group {
    margin-bottom: 20px; /* Add some space between form groups */
  }
</style>
</style>
<?php
include 'dashboard.php';
$get_id = $_GET['id'];
error_reporting(E_ALL); // show all errors

if(isset($_POST['edit_task']))
{
  $id           = $_POST['id'];
  $description  = $_POST['description'];
  $start_date   = $_POST['start_date'];
  $end_date     = $_POST['end_date'];
  $status       = 'Not Started';

  $servername  = "localhost";
  $username    = "root";
  $password    = "";
  $dbname      = "office";
  $conn        = mysqli_connect($servername, $username, $password, $dbname);

  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $query = "UPDATE tasks SET e_id='$id', description='$description', start_date='$start_date', end_date='$end_date', status='$status' WHERE t_id='$get_id'";

  $result = mysqli_query($conn, $query);

  if($result)
  {
    echo "<script>alert('Task updated Successfully');</script>";
    echo "<script type='text/javascript'> document.location = 'manage_task.php'; </script>";
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
</head>
<body>
<main class="main-container" id="main">
  <div class="main-title">
    <h2>Edit Task file</h2>
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
      <label>Select user:</label>
      <select class="form-control" name="id" required>
        <option>-Select-</option>
        <?php
        $query1     = "SELECT e_id,fname FROM register";
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "office";
        $conn       = mysqli_connect($servername, $username, $password, $dbname);
        $query_run1 = mysqli_query($conn, $query1);
        if(mysqli_num_rows($query_run1)){
          while($row1 = mysqli_fetch_assoc($query_run1)){
            $selected = ($row1['e_id'] == $row['id']) ? "selected" : "";
            ?>
            <option value="<?php echo $row1['e_id'] ?>" <?php echo $selected ?>>
              <?php echo $row1['fname'] ?>
            </option>
            <?php                    
          }
        }
        ?>
      </select>
    </div><br>
    <div class="form-group">
     <label>Description:</label>
      <textarea class="form-control" rows="3" cols="50" name="description" required="true" autocomplete="off"><?php echo $row['description'] ?></textarea>

    </div><br>
    <div class="form-group">
        <label>Start date:</label>
        <input type="date" class="form-control" name="start_date" value= "<?php echo $row['start_date']; ?>" required="true" autocomplete="off">

    </div><br>
    <div class="form-group">
        <label>End date:</label>
        <input type="date" class="form-control" name="end_date" value= "<?php echo $row['end_date']; ?>" required="true" autocomplete="off">
    </div><br><br>
    <input class="btn btn-warning" type="Submit"  value="UPDATE" name="edit_task"  id="edit_task">
   
   
  </form>
</body>
</html>  

