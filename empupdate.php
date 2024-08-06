<?php include 'edashboard.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>employee update</title>
    <style>
        /* Table styles */
        table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
        }

        th, td {
        text-align: center;
        padding: 10px;
        border: 1px solid black;
        }

        th {
        background-color: #f2f2f2;
        color: black;
        }

        /* Main title styles */
        .main-title {
        margin-top: 30px;
        text-align: center;
        }

        /* Update link styles */
        a {
        color: #1E90FF;
        text-decoration: none;
        }

        a:hover {
        text-decoration: underline;
        }

    </style>
</head>
<body>
    <main class="main-container">
        <div class="main-title">
            <h2>YOUR TASKS</h2>
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
    $username = "root";
    $password = "";
    $dbname = "office";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sno = 1;
    if (isset($_SESSION['e_id'])) {
        $query = "SELECT * FROM tasks WHERE e_id = ".$_SESSION['e_id'];
        if ($query_run = mysqli_query($conn, $query)) {
            if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    echo "<tr>";
                    echo "<td>" . $sno . "</td>";
                    echo "<td>" . $row['t_id'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['start_date'] . "</td>";
                    echo "<td>" . $row['end_date'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td><a href='update_status.php?id=".$row['t_id']."'>update</a></td>";
                    echo "</tr>";
                    $sno++;
                }
            } else {
                echo "No tasks found.";
            }
        } else {
            echo "Error in query: " . mysqli_error($conn);
        }
    } else {
        echo "e_id is not set.";
    }
?>

        </table>
    </main>
</body>
</html>
