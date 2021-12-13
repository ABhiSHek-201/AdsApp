<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">Adsapp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/advertisements.php">My Advertisements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/new_ad.php">New Advertisements</a>
                </li>
            </ul>
            <div class="col-lg-6" id="indent">
                <ul class="navbar-nav">
                    <?php
                        if(isset($_SESSION['user_name'])){
                            echo '<li class="nav-item dropdown" id="loggedIn">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Account
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="/logout.php">Logout</a></li>
                                </ul>
                            </li>';
                        }else{
                            echo '<li class="nav-item" id="loggedOut">
                                <span class="navbar-text">
                                    <a class="btn btn-success"href="/login.php" >Login</a>
                                    <a class="btn btn-outline-success" href="/signup.php">Signup</a>
                                </span>
                            </li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</nav>