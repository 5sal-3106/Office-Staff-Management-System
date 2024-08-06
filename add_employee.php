<?php include 'dashboard.php';
error_reporting(0);

    if($_POST['Register'])
    {
        
        $Full_Name        = $_POST['Full_Name'];
        $User_Name        = $_POST['User_Name'];
        $Email            = $_POST['Email'];
        $Phone_Number     = $_POST['Phone_Number'];
        $Password         = $_POST['Password'];
      
        $Gender           = $_POST['gender'];
        
       
        
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "office";
    

    $conn = mysqli_connect($servername,$username,$password,$dbname);

    

        $query = "INSERT INTO REGISTER VALUES('','$Full_Name','$User_Name','$Email','$Phone_Number','$Password','$Gender')";
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
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body{
    display: flex;
    height: 100vh;
    justify-content: center;
    align-items: center;
    padding: 10px;
    width: 100;
    background: linear-gradient(to top, rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%), url(register.jpg);
    background-position: center;
    background-size: cover;
}


.logo img{
    position: fixed;
    width: 150px;
    height: auto;
    left: 15px;
    top: 5%;
}


li a{
    text-decoration: none;
    color: #fff;
    border: 1px solid #fff;
    transition: 0.6s ease;
    margin: 40px 8px;
    padding: 10px 30px;
    position: fixed;
    width: 120px;
    height: auto;
    left: 10px;
    top: 15%;
}

li a:hover{
    background-color: #fff;
    color: #000;
}
.container{
    max-width: 700px;
    width: 100%;
    background: #fff;
    position: absolute;
    left: 25%;
    top: 12%;
    padding: 25px 30px;
    border-radius: 5px;
}

.container .title{
    font-size: 25px;
    font-weight: 500;
    position: relative;
}

.container .title::before{
    content: '';
    position: absolute;
    left:0;
    bottom: 0;
    height: 3px;
    width: 3px;
    
}

.container form .user-details{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 20px 0 12px 0;
}

form .user-details .input-box{
    margin-bottom: 15px;
    width: calc(100% / 2 - 20px);
}

.user-details .input-box .details{
    display: block;
    font-weight: 500;
    margin-bottom: 5px;
}
 
.user-details .input-box input{
    height: 45px;
    width: 100%;
    outline: none;
    border-radius: 5px;
    border: 1px solid #ccc;
    padding-left: 15px;
    font-size: 16px;
    border-bottom-width: 2px;
    transition: all 0.3s ease;
}
.user-details .input-box select{
    height: 45px;
    width: 100%;
    outline: none;
    border-radius: 5px;
    border: 1px solid #ccc;
    padding-left: 15px;
    font-size: 16px;
    border-bottom-width: 2px;
    transition: all 0.3s ease;
}

.user-details .input-box input:focus,
.user-details .input-box input:valid{
    border-color: #f5780a;
}



form .gender-details .gender-title{
    font-size: 20px;
    font-weight: 500;
}

form .gender-details .category{
    display: flex;
    width: 40%;
    margin: 14px 0;
    justify-content: space-between;
}
.gender-details .category label{
    display: flex;
    align-items: center;
}
.gender-details .category .dot{
    height: 18px;
    width: 18px;
    background: #d9d9d9;
    border-radius: 50%;
    margin-right: 10px;
    border: 5px solid transparent;
    transition: all 0.3s ease;
}

#dot-1:checked ~ .category label .one,
#dot-2:checked ~ .category label .two{
    border-color: #d9d9d9;
    background: #9b59b6;
}

form input[type="radio"]{
    display: none;
}
form .button{
    height: 45px;
    margin: 45px 0;
}

form .button input{
    cursor: pointer;
    height: 100%;
    width: 100%;
    margin: 17px 0;
    outline:none;
    color: #fff;
    border: none;
    font-size: 18px;
    font-weight: 500;
    border-radius: 5px;
    letter-spacing: 1px;
    background: linear-gradient(135deg, #f5780a, #fc0303);
}   
form .button input:hover{
    background: linear-gradient(-135deg, #f5780a, #fc0303);
}
    
</style>
    

</head>

<body>
<div class="container">
        <div class="main-title">
          <h2>ADD EMPLOYEE</h2>
        </div>
    <div class ="row">
        <div class="col-md-6">
            <form action="" method="post">
            <body>
    
    
    <div class="logo">
        <img src="logo.png">
    </div>
    
        

    <div class="container">
       
        
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Full Name</span>
                    <input type="text" placeholder="Enter your full name" name="Full_Name" required>
                </div>
                <div class="input-box">
                    <span class="details">User Name</span>
                    <input type="text" placeholder="Enter your User name" name="User_Name" required>
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" placeholder="Enter your Email" name="Email" required>
                </div>
                <div class="input-box">
                    <span class="details">Phone Number</span>
                    <input type="tel" placeholder="Enter 10 Digit Phone Number" pattern="[0-9]{10}" name="Phone_Number" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" placeholder="Enter your Password" minlength="10" name="Password" required>
                </div>
                
                
                <div class="input-box">
                    <span class="details">Gender</span>
                    <select name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                
                
            </div>
            <div class="button">
                <input type="submit" value="Register" name="Register">
                <p style="text-align: center;"  >Already have an account? <a href="emplogin.html">Login now</a></p>
            </div>
        </form>
    </div>
</body>    
</html>
</body>


</html>