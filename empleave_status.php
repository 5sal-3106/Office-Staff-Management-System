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
            <h2>YOUR LEAVE STATUS</h2>
        </div>
        <table class="table">
            <tr>
                <th>S.No</th>
                <th>Leave ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "office";
                $conn = mysqli_connect($servername, $username, $password, $dbname);

                // prepare the statement
                $query = "SELECT * FROM `leaves` WHERE e_id = ?";
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
                    echo "<td>" . $row['l_id'] . "</td>";
                    echo "<td>" . $row['uname'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    
                    // Highlight status column based on status value
                    if ($row['status'] == 'Pending') {
                        echo "<td class='status-pending'>" . $row['status'] . "</td>";
                    } else if ($row['status'] == 'Approved') {
                        echo "<td class='status-approved'>" . $row['status'] . "</td>";
                    } else if ($row['status'] == 'Rejected') {
                        echo "<td class='status-rejected'>" . $row['status'] . "</td>";
                    } else {
                        echo "<td>" . $row['status'] . "</td>";
                    }
                    
                    echo "</tr>";
                    $sno++;
                }
                

            ?>
        </table>
    </main>
</body>
</html>
