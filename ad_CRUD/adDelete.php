<?php
    session_start();
    include('../connection.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "delete from advertiements where id = '$id'";
        $query = mysqli_query($conn, $sql);

        if($query){
            echo "<script> alert('Deleted Advertisement') </script>";	
            echo " <script>window.open('/index.php','_self')</script> ";
        }
        else{
            echo "<script> alert('Something Went Wrong') </script>";	
            echo " <script>window.open('/index.php','_self')</script> ";
        }
    }

?>