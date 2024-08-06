<?php
error_reporting(0);
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "office";


    $conn       = mysqli_connect($servername,$username,$password,$dbname);

        $query  = "SELECT * FROM REGISTER";
        $data   = mysqli_query($conn, $query);

        $total  = mysqli_num_rows($data);
        $result = mysqli_fetch_assoc($data);

        echo $result[fname]." ".$result[uname]." ".$result[email]." ".$result[phno]." ".$result[password]." ".$result[conpassword]." ".$result[gender];
      
        //echo $total;

        if($total != 0)
        {
          //  echo "table has records";
        }
        else
        {
            echo "table has no records";
        }
?>