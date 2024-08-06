<?php 
    include 'edashboard.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leave status</title>
    <style>
        <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    
    th, td {
        text-align: left;
        padding: 8px;
    }
    
    tr:nth-child(even) {
        background-color: white;
    }
    
    th {
        background-color: #4CAF50;
        color: white;
    }

    .status-pending {
        color: #FFA500;
        font-weight: bold;
    }

    .status-approved {
        color: #008000;
        font-weight: bold;
    }

    .status-rejected {
        color: #FF0000;
        font-weight: bold;
    }
</style>

    </style>
</head>
<body>
    <main class="main-container">
        <div class="main-title">
            <h2>YOUR ATTENDANCE STATUS</h2>
        </div>
        <table class="table">
            <tr>
                <th>S.No</th>
                
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "office";
                $conn = mysqli_connect($servername, $username, $password, $dbname);

                // prepare the statement
                $query = "SELECT * FROM `attendance` WHERE employee_id = ?";
                $stmt = mysqli_prepare($conn, $query);

                // bind parameters
                mysqli_stmt_bind_param($stmt, "i", $_SESSION['e_id']);

                // execute the statement
                mysqli_stmt_execute($stmt);

                // get the result
                $result = mysqli_stmt_get_result($stmt);

                // loop through the results
                $sno = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $sno . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['time'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    
                    // Highlight status column based on status value
               
                    
                    echo "</tr>";
                    $sno++;
                }
                

            ?>
        </table>
    </main>
</body>
</html>
