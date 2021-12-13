<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create New Advertisements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <?php
        include('./nav.php');
    ?>

    <div class="container my-4">    
        <div class="col-md-12">
            <div class="row" id="show_all_published_ads">
                <?php
                    include('./connection.php');
                    
                    if(isset($_SESSION['user_email'])){
                        $email = $_SESSION['user_email'];
                        $sql = "select * from users where email = '$email'";
                        $query = mysqli_query($conn,$sql);
                        $usr= mysqli_fetch_array($query);
                        
                        if($usr){
                            $id = $usr['id'];
                            
                            echo '
                            <form method="post">
                                <div class="mb-3">
                                    <label for="ad_name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="ad_name">
                                </div>
                                <div class="mb-3">
                                    <label for="ad_title" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="ad_title">
                                </div>
                                <div class="mb-3">
                                    <label for="ad_desc" class="form-label">Description</label>
                                    <input type="text" class="form-control" name="ad_desc">
                                </div>
                                <button type="submit" name="create" class="btn btn-primary">Create</button>
                            </form>';

                        }
                        else{
                            echo "<script> alert('Unauthenticated User') </script>";	
                            echo " <script>window.open('./index.php','_self')</script>";	 
                        }
                        
                    }else{
                        echo "<script> alert('Login Required') </script>";	
                        echo " <script>window.open('./index.php','_self')</script>";	
                    }

                    if(isset($_POST["create"])){
                        $ad_name = $_POST['ad_name'];
                        $ad_title = $_POST['ad_title']; 
                        $ad_desc = $_POST['ad_desc']; 
                
                        $sql = "insert into advertiements(ad_name,ad_title,ad_desc,creator) values('$ad_name','$ad_title','$ad_desc','$id')";
                        $query = mysqli_query($conn,$sql);
                
                        if($query){
                            echo "<script> alert('Created New Advertisement Succesfully') </script>";	
                            echo "<script>window.open('./index.php','_self')</script> ";
                        }
                        else{
                            echo "<script> alert('Something Went Wrong') </script>";	
                            echo " <script>window.open('./index.php','_self')</script> ";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>