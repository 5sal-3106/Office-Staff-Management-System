<?php 
error_reporting(0);
if($_POST['create_task'])
{
    $id               = $_POST['id'];
    $description      = $_POST['description'];
    $start_date       = $_POST['start_date'];
    $end_date         = $_POST['end_date'];
    $status           = 'Not Started';
    
 
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "office";
    

    $conn = mysqli_connect($servername,$username,$password,$dbname);
    $query = "INSERT INTO tasks VALUES('','$id','$description','$start_date','$end_date','Not Started')";
    $data = mysqli_query($conn,$query);


    if($data)
    {
        header("location:manage_task.php");
        }
    else{
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
body {
    background: url('new.jpg') center/cover no-repeat;

}
</style>
    

</head>

<body>
<li><a href="adminhome.php">DASHBOARD</a></li>
    <main class="main-container" >
        <div class="main-title">
          <h2>CREATE TASK</h2>
        </div>
    <div class ="row">
        <div class="col-md-6">
            <form action="" method="post">
                <div class="form-group">
                    <label>select user:</label>
                    <select class="form-control" name="id" required>
                        <option>-Select-</option>
                        <?php
                            
                            $query="select e_id,fname from register";
                            $servername = "localhost";
                            $username   = "root";
                            $password   = "";
                            $dbname     = "office";
                            $conn = mysqli_connect($servername,$username,$password,$dbname);
                            $query_run = mysqli_query($conn,$query);
                            if(mysqli_num_rows($query_run)){
                                while($row = mysqli_fetch_assoc($query_run)){
                                    ?>
                                    <option value="<?php echo $row['e_id']?>"><?php echo $row['fname']; ?>
                                    </option>
                                    <?php                    
                                }
                            }
                        ?>
                    </Select>
                </div><br>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea class ="form-control" rows="3" cols="50" name="description" placeholder="Mention the Task" required></textarea>
                </div><br>
                <div class="form-group">
                    <label>Start date:</label>
                    <input type="date" class="form-control" name="start_date" required>
                </div><br>
                <div class="form-group">
                    <label>End date:</label>
                    <input type="date" class="form-control" name="end_date" required>
                </div><br><br>
                <input type="Submit" class="btn btn-warning" name="create_task" value="Create">
            </form> 
        </div>
    </div>
</body>


</html>