<?php
session_start();
include('./connection.php');

if(isset($_SESSION['user_email'])){
    if(isset($_POST['commentBtn'])){
        $email = $_SESSION['user_email'];
        $sql = "select id from users where email = '$email'";
        $query = mysqli_query($conn,$sql);
        $usr = mysqli_fetch_array($query);
        if($usr){
            $user_id = $usr['id'];
        }

        $msg = $_POST['content'];
        $id = $_GET['id'];

        if($msg!=""){
            $sql = "insert into comments(adv_id,author,msg) values('$id','$user_id','$msg')";
            $query = mysqli_query($conn,$sql);
            if($query){
                echo "<script>alert('Commented Successfully')</script>";
                echo "<script>window.open('/ad_CRUD/adView.php?id={$id}','_self')</script>";
            }
            else{
                echo "<script>alert('Something Went Wrong.')</script>";
                echo "<script>window.open('/ad_CRUD/adView.php?id={$id}','_self')</script>";
            }
        }
        else{
            echo "<script>alert('Type something to comment')</script>";
            echo "<script>window.open('/ad_CRUD/adView.php?id={$id}','_self')</script>";
        }
    }
}
else{
    echo "<script>alert('Login Required')</script>";
    echo "<script>window.open('/login.php','_self')</script>";
}
?>