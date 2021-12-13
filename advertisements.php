<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Advertisements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <?php
        include('./nav.php');
    ?>

    <div class="container my-4">    
        <div class="col-md-12">
            <center>
                <h1>My Advertisements</h1>
            </center>
            <div class="row" id="show_all_published_ads">
                <?php
                    include('./connection.php');
                    if(isset($_SESSION['user_name'])){
                        $email = $_SESSION['user_email'];
                        $sql = "select * from users where email = '$email' or username = '$email'";
                        $query = mysqli_query($conn,$sql);
                        $user = mysqli_fetch_array($query);
                        if ($user){
                            $id = $user["id"];
                            $sql1 = "select * from advertiements where creator = '$id' ORDER BY id DESC";
                            $query1 = mysqli_query($conn,$sql1);
                            $check_ads = mysqli_num_rows($query1);
                            
                            if($check_ads!=0){
                                $ads= mysqli_fetch_all($query1);
                                foreach($ads as $ad){
                                    $desc = substr($ad['3'],0,10);
                                        echo "<div class='card mb-3'>
                                                <div class='card-header'>{$ad['4']}</div>
                                                <div class='card-body'>
                                                    <h5 class='card-title'>{$ad['2']}</h5>
                                                    <p class='card-text'>{$desc}...</p>
                                                    <a href='/ad_CRUD/adView.php?id={$ad['0']}' class='btn btn-primary'>View</a>
                                                    <a href='/ad_CRUD/adEdit.php?id={$ad['0']}' class='btn btn-success'>Edit</a>
                                                    <a href='/ad_CRUD/adDelete.php?id={$ad['0']}' class='btn btn-danger'>Delete</a>";
                                                    
                                                    if($ad['5'] == 0){
                                                        echo "<a href='/ad_CRUD/adPublish.php?id={$ad['0']}' class='mx-2 btn btn-secondary'>Publish</a>";
                                                    }
                                                    else{
                                                        echo "<a href='/ad_CRUD/adUnpub.php?id={$ad['0']}' class='mx-2 btn btn-outline-secondary'>Unpublish</a>"; 
                                                    }
                                                    echo "
                                                </div>
                                            </div>";
                                }
                            }
                            else{
                                echo "<h1>No Advertisements.</h1>";
                            }
                            
                        }
                    }else{
                        echo "<script> alert('Login Required') </script>";	
                        echo " <script>window.open('/login.php','_self')</script> ";	
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>