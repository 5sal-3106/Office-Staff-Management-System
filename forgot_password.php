
<?php 
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "office";
    

    $conn = mysqli_connect($servername,$username,$password,$dbname);


  if(isset($_POST['updateNewPassword'])){
    $username = $_POST['usernameemail'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $duplicate = mysqli_query($conn, "SELECT * FROM register WHERE uname = '$username' or email='$username'");
    if(mysqli_num_rows($duplicate)>0){
        if($password == $password2){
        $query = "UPDATE register SET password='$password'  WHERE uname ='$username' or email='$username'";
        mysqli_query($conn, $query);
        // header('Location: login.php');
        echo 'Password Updated';
        }
        
        else{
            echo "Password Does not match!";
          }  
    }
       else{
        echo "Username Does not match!";
      }
   
  }


if(isset($_POST['submit'])){
  $usernameemail = $_POST['usernameemail'];
  $mobile = $_POST['mobile'];
  $result = mysqli_query($conn, "SELECT * FROM register WHERE uname = '$usernameemail' OR email = '$usernameemail' and phno = '$mobile'"  );
  $row = mysqli_fetch_assoc($result);

  if(mysqli_num_rows($result)>0){
      echo " <script> alert('User registered') </script> ";
      ?>
      <div class="mx-5 my-2">
      <h2>Create new password</h2>
        <button class="m-2 btn btn-danger btn-secondary-outline" onclick="displayPasswordCol()" >Click here</button>
        </div>
        <?php
   
  }
  else{
    echo " <script> alert('User Not registered') </script> ";
    // header('Location: signup.php');
  }
}

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login </title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="#">
  <style>
    .newpass{
        display: none;
    }
    .showNewPass{
        display: block;
    }
  </style>
  <style>
    
  </style>
</head>
<body>
  <main>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="login-wrapper m-0">
            <h1 class="login-title">Forgot Password</h1>
            <form action="" method = "post">
              <div class="form-group">
                <label for="usernameemail">Username / Email</label>
                <input type="text" name="usernameemail" id="email" class="form-control" placeholder="Enter your ID">
              </div>
              <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="mobile" name="mobile" id="mobile" class="form-control" placeholder="Enter your mobile number">
              </div>
              <div class="newpass">
              <div class="form-group mb-4">
                <label for="password">Create New Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your passsword">
              </div>
              <div class="form-group mb-4">
                <label for="password2">Confirm New Password</label>
                <input type="password" name="password2" id="password2" class="form-control" placeholder="Confirm your passsword">
            </div>
            <button type="submit"  name="updateNewPassword" id="submit" class="btn btn-block login-btn"  value="updateNewPassword">Update New Password</button>
              </div>
              <button type="submit"  name="submit" id="submit" class="btn btn-block login-btn"  value="submit">Search</button>
            </form>
            <p class="login-wrapper-footer-text">Don't have an account? <a href="register.html" class="text-reset">Register here</a></p>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="https://cdn.decorilla.com/online-decorating/wp-content/uploads/2020/11/Moody-home-office-background-with-builtin-shelves-by-WhittneyParkinson.jpg" alt="login image" class="login-img">
            
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script>

    function displayPasswordCol() {
        var content = document.querySelector('.newpass');
        content.classList.toggle('showNewPass');
    }
    document.querySelector('.submit').addEventListener('click', (event)=>{
        event.displayPasswordCol();
    });
  </script>
</body>
</html>