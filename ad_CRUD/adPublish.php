<?php
    session_start();
    include('../connection.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "select * from advertiements where id='$id'";
        $query = mysqli_query($conn, $sql);
        if($query){
            $ad=mysqli_fetch_array($query);
            if($ad['is_published'] == 1){
                echo "<script> alert('Already Published') </script>";	
                echo " <script>window.open('/index.php','_self')</script> ";
            }
            else{
                $sql = "update advertiements set is_published=1 where id = '$id'";
                $query = mysqli_query($conn, $sql);

                if($query){
                    echo "<script> alert('Published Advertisement') </script>";	
                    echo " <script>window.open('/index.php','_self')</script> ";
                }
                else{
                    echo "<script> alert('Something Went Wrong') </script>";	
                    echo " <script>window.open('/index.php','_self')</script> ";
                }
            }
        }
        else{
            echo "<script> alert('Something Went Wrong')</script>";	
            echo " <script>window.open('/index.php','_self')</script>";
        }
    }

?>