<?php
    if($_POST['Register'])
    {
        $Full_Name        = $_POST['Full_Name'];
        $User_Name        = $_POST['User_Name'];
        $Email            = $_POST['Email'];
        $Phone_Number     = $_POST['Phone_Number'];
        $Password         = $_POST['Password'];
        $Confirm_Password = $_POST['Confirm_Password'];
        $Gender           = $_POST['gender'];
        
       
        
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "office";
    

    $conn = mysqli_connect($servername,$username,$password,$dbname);

    

        $query = "INSERT INTO REGISTER VALUES('$Full_Name','$User_Name','$Email','$Phone_Number','$Password','$Confirm_Password','$Gender')";
        $data = mysqli_query($conn,$query);
        
        if($data)
        {
            header("location:empreg.html");
        }
        else
        {
            echo "failed";
        }
    }
    ?>
