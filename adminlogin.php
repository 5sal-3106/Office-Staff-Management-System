<?php
    $Email            = $_POST['Email'];
    $Password         = $_POST['Password'];

    $con = new mysqli("localhost","root","","office");

    session_start();


    if($con->connect_error) {
        die("Failed to connect : ".$con->connect_error);
    } else {
        $stmt = $con->prepare("select * from admin where email = ?");
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            $data = $stmt_result->fetch_assoc();
            if($data['password'] === $Password) 
            {
                $_SESSION["Email"]=$Email;
                header("location:adminhome.php");
            } else {
                header("location:admin_password.php");
            }
        } else {
            header("location:admin_password.php");
        }
    }
?>  