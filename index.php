<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AdsApp</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>

    <body>
        <?php 
            include('./nav.php')
        ?>

        <div class="container my-4">    
            <div class="col-md-12">
                <center>
                    <h1>Published Advertisements</h1>
                </center>
                <div class="row" id="show_all_published_ads">
                    <?php
                        include("./connection.php");

                        $sql = "select * from advertiements where is_published = 1 ORDER BY id DESC";

                        $query=mysqli_query($conn,$sql);
                        if ($query){
                            $check_ads= mysqli_num_rows($query);
                            if($check_ads!=0){
                                $ads= mysqli_fetch_all($query);
                                foreach($ads as $ad){
                                    $desc = substr($ad['3'],0,10);
                                    echo "<div class='card mb-3'>
                                            <div class='card-header'>{$ad['4']}</div>
                                            <div class='card-body'>
                                                <h5 class='card-title'>{$ad['2']}</h5>
                                                <p class='card-text'>{$desc}...</p>
                                                <a href='/ad_CRUD/adView.php/?id={$ad['0']}' class='btn btn-primary'>View</a>
                                            </div>
                                        </div>";
                                }
                            }
                            else{
                                echo "<h1>No Advertisements.</h1>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>
