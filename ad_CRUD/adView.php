<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Advertisements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <?php
        include('../nav.php');
    ?>

    <div class="container my-4">    
        <div class="col-md-12">
            <div class="row" id="show_all_published_ads">
                <?php
                    include('../connection.php');
                    
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                    
                        $sql1 = "select * from advertiements where id = '$id'";
                        $query1 = mysqli_query($conn,$sql1);
                        $ad= mysqli_fetch_array($query1);
                        if($ad){
                            // $desc = substr($ad['4'],0,10);
                            echo "<div class='card mb-3'>
                                    <div class='card-header'><center><h1>{$ad['ad_name']}</h1></center></div>
                                    <div class='card-body'>
                                        <h5 class='card-title'>Title: {$ad['ad_title']}</h5>
                                        <h6 class='my-3 card-title'>Description:</h6>
                                        <p class='card-text'>{$ad['ad_desc']}</p>";

                                        if(isset($_SESSION['user_name'])){
                                            $email = $_SESSION['user_email'];
                                            $sql = "select * from users where email = '$email' or username = '$email'";
                                            $query = mysqli_query($conn,$sql);
                                            $user = mysqli_fetch_array($query);
                                            if ($user){
                                                $id = $user["id"];
                                                if($id == $ad['1']){
                                                    echo "<a href='/ad_CRUD/adEdit.php?id={$ad['0']}' class='btn btn-success'>Edit</a>
                                                    <a href='/ad_CRUD/adDelete.php?id={$ad['0']}' class='btn btn-danger'>Delete</a>";
                                                    
                                                    if($ad['5'] == 0){
                                                        echo "<a href='/ad_CRUD/adPublish.php?id={$ad['0']}' class='mx-2 btn btn-secondary'>Publish</a>";
                                                    }
                                                    else{
                                                        echo "<a href='/ad_CRUD/adUnpub.php?id={$ad['0']}' class='mx-2 btn btn-outline-secondary'>Unpublish</a>"; 
                                                    }
                                                }
                                            }
                                        }
                                        echo "
                                    </div>
                                </div>";
                        }
                        else{
                            echo "<script> alert('No Such Advertisement') </script>";	
                            echo " <script>window.open('/index.php','_self')</script> ";	 
                        }
                        
                    }else{
                        echo "<script> alert('Invalid Advertisement') </script>";	
                        echo " <script>window.open('/index.php','_self')</script> ";	
                    }
                ?>

            
                <div class='card mb-3'>
                    <div class='card-header'><center><h1>Comments</h1></center></div>
                    <form action="/comments.php?id=<?php echo $ad['0']; ?>" method="post" id="f">
                        <textarea class="form-control" id="content" rows="4" name="content" placeholder="What's in your mind?"></textarea><br>
                        <button id="btn-post" name="commentBtn" class="btn btn-success" name="sub">Comment</button>
                    </form><br>
                    <?php
                        $sql = "select * from comments where adv_id = {$ad['0']} ORDER BY id DESC";
                        $query = mysqli_query($conn, $sql);
                        $comments = mysqli_fetch_all($query);

                        foreach($comments as $comment){
                            $sql = "select * from users where id = {$comment['2']}";
                            $query = mysqli_query($conn,$sql);
                            $usr = mysqli_fetch_array($query); 
                            if($usr){
                                echo "
                                <hr>
                                <div class='card-body'>
                                <div class='row'>
                                    <div class='col-sm-2'>
                                        <p><img src='../image/images.jpeg' class='img-circle' width='100px' height='100px'></p>
                                    </div>
                                    <div class='col-sm-6'>
                                        <p class='card-text'>{$comment['3']}</p>  
                                    </div>
                                </div>
                                <div class='row'>
                                    <h6 class='card-title'>{$usr['username']}</h6>
                                </div>
                                </div>
                                ";
                            }   
                        }
                    ?>                     
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>