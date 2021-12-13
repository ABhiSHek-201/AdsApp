<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Advertisements</title>
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
                    
                        $sql1 = "select ad_name,ad_desc,ad_title from advertiements where id = '$id'";
                        $query1 = mysqli_query($conn,$sql1);
                        $ad = mysqli_fetch_array($query1);
                        if($ad){
                            $ad_name = $ad['ad_name'];
                            $ad_desc = $ad['ad_desc'];
                            $ad_title = $ad['ad_title'];

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


                    
                    <form method="post">
                        <div class="mb-3">
                            <label for="ad_name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="ad_name" value='<?php print($ad_name); ?>'>
                        </div>
                        <div class="mb-3">
                            <label for="ad_title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="ad_title" value='<?php echo $ad_title;?>'>
                        </div>
                        <div class="mb-3">
                            <label for="ad_desc" class="form-label">Description</label>
                            <input type="text" class="form-control" name="ad_desc" value='<?php echo $ad_desc;?>'>
                        </div>
                        <a href="./index.php"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
                        <button type="submit" name="edit" class="btn btn-primary" style="float:right;">Edit</button>
                    </form>
                    <?php

                    if(isset($_POST["edit"])){
                        $ad_name = $_POST['ad_name'];
                        $ad_title = $_POST['ad_title']; 
                        $ad_desc = $_POST['ad_desc']; 
                
                        $sql = "update advertiements set ad_name='$ad_name', ad_title = '$ad_title', ad_desc='$ad_desc' where id = '$id'";
                        $query = mysqli_query($conn,$sql);
                
                        if($query){
                            echo "<script> alert('Edited Succesfully') </script>";	
                            echo "<script>window.open('/ad_CRUD/adView.php?id={$id}','_self')</script> ";
                        }
                        else{
                            echo "<script> alert('Something Went Wrong') </script>";	
                            echo " <script>window.open('/index.php','_self')</script> ";
                        }
                
                
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>