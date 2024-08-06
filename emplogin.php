<?php
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    $con = new mysqli("localhost","root","","office");

    session_start();

    if($con->connect_error) {
        die("Failed to connect : ".$con->connect_error);
    } else {
        $stmt = $con->prepare("select * from register where email = ?");
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            $data = $stmt_result->fetch_assoc();
            if($data['password'] === $Password) {
                $_SESSION["Email"] = $Email;
                $_SESSION["e_id"] = $data['e_id'];
                echo "e_id value: ".$_SESSION["e_id"]; // debugging statement
                header("location:emphome.php");
            } else {
                header("location:forgot_passwords.php");
            }
        } else {
            header("location:forgot_passwords.php");
        }
    }
?>
