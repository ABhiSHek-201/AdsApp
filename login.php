<?php
  session_start();
  include("./connection.php");
  if(!isset($_SESSION['user_email'])){
    if(isset($_POST['signin'])){
      $uname = $_POST['username'];
      $pwd = $_POST['password'];

      $sql = "select * from users where username = '$uname' OR email = '$uname'";

      $query=mysqli_query($conn,$sql);
      $user = mysqli_fetch_array($query);
      if ($user){
        if($user['password'] == $pwd){
          $_SESSION['user_name']=$user['username'];
          $_SESSION['user_email']=$user['email'];
          echo "<script> alert('Welcome to AdsApp') </script>";	
          echo " <script>window.open('/index.php','_self')</script> ";	
          
        }
        else{
          echo "<script> alert('Invalid Password') </script>";
        } 
      }else{
        echo "<script> alert('Invalid User') </script>";
      }
    }
  }
  else{
    echo "<script> alert('Already Logged In') </script>";
    echo "<script> window.open('/index.php','_self') </script>";
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Page</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/signin.css" rel="stylesheet">
    <link href="./css/font-awesome.min.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-lg-push-5">
          <h1 id="tra_head" style="color:black;">Login To Continue</h1>
        </div>
      </div>

      <div class="row" style="margin-top:141px">
        <div class="col-md-12">
          <form class="form-signin" action="#" method="post">
            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

            <div class="row">
              <div class="col-md-6">
                <button class="btn btn-lg btn-primary btn-block" name="signin" type="submit" style="background-color: #1abc9c; border-color:#9099A2;">Sign in</button>
              </div> 

              <div class="col-md-6">
                <a href="/signup.php" class="btn btn-lg btn-primary btn-block" type="submit" style="background-color: #1abc9c; border-color:#9099A2;">Sign up</a>
              </div>
            </div>  
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
