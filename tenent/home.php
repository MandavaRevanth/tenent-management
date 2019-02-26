<!DOCTYPE html>
<?php  session_start();?>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
        <style>
            body{
                background:url("home.jpg");
                background-repeat:no-repeat;
                background-size:cover;
            }
        </style>
        <link href="https://fonts.googleapis.com/css?family=Pacifico|Rammetto+One" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <?php if(!isset($_SESSION['userid'])) print "<li><a href='login.php'>LogIn</a></li>"; ?>
                    <?php if(!isset($_SESSION['userid'])) print '<li><a href="signup.php">SignUp</a></li>'; ?>
                    <?php if(isset($_SESSION['userid'])) print '<li><a href="upload.php">Upload</a></li>'; ?>
                    <?php if(isset($_SESSION['userid'])) print '<li><a href="logout.php">LogOut</a></li>'; ?>
                </ul>
            </nav>
        </header>
        <div id="home">
            <h1>Homes are heaven,</h1>
            <h1>We help you find yours</h1>
        </div>
        <footer>

        </footer>

    </body>
</html>