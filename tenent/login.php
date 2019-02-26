<!DOCTYPE html>
<html>
    <head>
        <title>The Login Page</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            body{
                background:url("login.jpg");
                background-size:cover;
                background-repeat:no-repeat;
            }
        </style>
    </head>
    <body>
        <?php
            function process($data){
                $data=htmlspecialchars($data);
                $data=trim($data);
                $data=stripslashes($data);
                return $data;
            }
            $userErr=$passErr="";
            if(isset($_POST['submit'])){
                $username=$password="";
                # error msgs
                $userErr=$passErr="";
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    if(empty($_POST["username"])) $userErr="username required"; else $username=process($_POST["username"]);
                    if(empty($_POST["password"])) $passErr="password required"; else $password=process($_POST["password"]);
                }
                
                $host="localhost";
                $user="root";
                $pass="";
                $db="tenantmangement";
                $conn =new mysqli($host,$user,$pass,$db);
                if($conn->connect_error){
                    die("connection failed". $conn->connect_error);
                }
                $sql="SELECT * from `users` WHERE  `username`='$username' AND `password`= '$password' ;";
                $result=$conn->query($sql);
                if( $result->num_rows > 0 ){
                    $val=$result->fetch_assoc();
                    if($val['password']===$password){
                        print "
                            <script>
                                alert('sucessfully logged in');
                            </script>
                        ";
                        session_start();
                        $_SESSION['username']=$val['username'];
                        $_SESSION['email']=$val['email'];
                        $_SESSION['userid']=$val['userId'];
                        header('location: upload.php');
                        
                    }else{
                        $passErr="Inccorect Password!!";
                    }
                }else{
                    print "<script>
                        alert('user does not exist ');
                    </script>";
                    header('location: signup.php');
                }
            }
            
        ?>
        <header>
            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="login.php">LogIn</a></li>
                    <li><a href="signup.php">SignUp</a></li>
                </ul>
            </nav>
        </header>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="loginForm" method="post">
            <label for="username">Username : </label>
            <input type="text" name="username" placeholder="username" id="username">
            <span class="errorMsg"> * <?php print $userErr ?></span>
            <br>
            <label for="password">Password : </label>
            <input type="password" name="password" placeholder="password" id="password" >
            <span class="errorMsg"> * <?php print $passErr ?></span>
            <br>
            <input type="submit" value="Submit" class="submit" name="submit">
            <input type="reset" value="Reset" class="reset">
        </form>
    </body>
</html>