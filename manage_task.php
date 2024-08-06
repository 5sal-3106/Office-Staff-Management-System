<!DOCTYPE html>
<html>
    <head>
        <title>Manage Task</title>
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

.main-container {
  width: 90%;
  margin: 0 auto;
}

.main-title {
  text-align: center;
  margin-bottom: 20px;
  color:yellow;
  background-color: red;
}

.table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  text-align: left;
  padding: 8px;
  border: 1px solid #080808;
}

th {
  background-color: green;
  font-weight: bold;
}

tr {
  background-color: white;
}

tr:hover {
  background-color: white;
}

.action-button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  cursor: pointer;
}
body {
    background: url('new.jpg') center/cover no-repeat;
    /* Additional styles... */
}

        </style>   
    </head>
    <body>
<li><a href="adminhome.php">DASHBOARD</a></li>
        <main class="main-container" >
            <div class="main-title">
                <h2>ALL ASSIGNED TASKS</h2>
            </div>
        <table class="table">
            <tr>
                <th>S.No</th>
                <th>Task Id</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
                $servername = "localhost";
                $username   = "root";
                $password   = "";
                $dbname     = "office";
                $conn       = mysqli_connect($servername,$username,$password,$dbname);
                $sno = 1;
                $query      = "select * from tasks";
                $query_run  = mysqli_query ($conn,$query);
                while($row = mysqli_fetch_assoc($query_run)){
                  ?> 
                  <tr>
                    <td> <?php echo $sno; ?> </td>
                    <td> <?php echo $row['t_id']; ?></td>
                    <td> <?php echo $row['description']; ?></td>
                    <td> <?php echo $row['start_date']; ?></td>
                    <td> <?php echo $row['end_date']; ?></td>
                    <td> <?php echo $row['status']; ?></td>
                    <td><a href="edit_task.php?id=<?php echo $row['t_id']; ?>">Edit  </a> | <a href="delete_task.php?id=<?php echo $row['t_id']; ?>">Delete</a></td>
                  </tr>   
                  <?php
                  $sno = $sno + 1;
                }
            ?>
        </table>
    </body>
</html>

