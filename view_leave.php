<!DOCTYPE html>
<html>
    <head>
        <title>view leave</title>
        <style>

          li {
            list-style: none; /* Remove default list styling */
          }

          a {
            text-decoration: none; /* Remove underline from links */
            color: #333; /* Set link color */
            display: inline-block; /* Display links as inline-block for better spacing */
            transition: color 0.3s ease; /* Add a smooth color transition on hover */
          }


          a:hover {
            color: #007bff; /* Change color to a different shade on hover */
          }

           /* Center the main title */
          .main-title {
            text-align: center;
            color:yellow;
            background-color: red;
          }

          /* Style the table */
          .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
          }

          /* Style the table headings */
          .table th {
            background-color: green;
            font-weight: bold;
            text-align: left;
            padding: 8px;
          }

          /* Style the table rows */
          .table tr {
            background-color: white;
          }

          /* Style the table cells */
          .table td {
            padding: 8px;
          }

          /* Style the action links */
          .table td a {
            color: #0066cc;
            text-decoration: none;
          }

          /* Style the action links when hovered over */
          .table td a:hover {
            text-decoration: underline;
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
                <h2>ALL LEAVE APPLICATIONS</h2>
            </div>
        <table class="table">
            <tr>
                <th>S.No</th>
                <th>Leave ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Leave Type</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Reason</th>
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
                $query      = "select * from leaves";
                $query_run  = mysqli_query ($conn,$query);
                while($row = mysqli_fetch_assoc($query_run)){
                  ?> 
                  <tr>
                    <td> <?php echo $sno; ?> </td>
                    <td> <?php echo $row['l_id']; ?></td>
                    <td> <?php echo $row['uname']; ?></td>
                    <td> <?php echo $row['email']; ?></td>
                    
                    <td> <?php echo $row['leave_type']; ?></td>
                    <td> <?php echo $row['from_date']; ?></td>
                    <td> <?php echo $row['to_date']; ?></td>
                    <td> <?php echo $row['reason']; ?></td>
                    <td> <?php echo $row['status']; ?></td>
                    <td><a href="approve_leave.php?id=<?php echo $row['l_id']; ?>">Approve  </a> | <a href="leave_rejected.php?id=<?php echo $row['l_id']; ?>">Reject</a></td>
                    
                  </tr>   
                  <?php
                  $sno = $sno + 1;
                }
            ?>
        </table>
    </body>
</html>

