<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['userid'])) header("location: home.php");
?>
<html>
    <head>
        <title>The Signup Page</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            body{
                background:url("signup2.jpg");
                background-repeat:no-repeat;
                background-size:cover;
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
            if(isset($_POST['submit'])){
                $username=$password=$confirm=$email=$phone="";
                # error messages
                $userErr=$passErr=$confErr=$phoneErr="";
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $username= process($_POST["username"]);
                    $password=process($_POST["password"]);
                    $confirm=process($_POST["repassword"]);
                    $email=process($_POST["email"]);
                    $phone=process($_POST["phone"]);
                }
                

                $host="localhost";
                $user="root";
                $pass="";
                $db="tenantmangement";
                $conn = new mysqli($host,$user,$pass,$db);
                if($conn->connect_error){
                    die("connection failed".$conn->connect_error);
                }
                $sql="INSERT INTO `users`(`username`, `password`, `email`, `phone` ) VALUES ('$username','$password','$email','$phone');";
                if($conn->query($sql)===true){
                    print "<script>
                        alert('sucessfully logged in')
                    </script>";
                }else{
                    print $conn->error;
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="signupForm" method="post">
            <label for="username" >Username : </label>
            <input type="text" name="username" placeholder="username" id="username" onkeyup="userVal()">
            <span class="errorMsg" id="userErr" hidden>* username required</span>
            <br>
            <label for="password">Password : </label>
            <input type="password" name="password" placeholder="password" id="password" onkeyup="passVal()" >
            <span class="errorMsg" id="passErr" hidden> * password required</span>
            <br>
            <label for="repassword">Confirm : </label>
            <input type="password" name="repassword" placeholder="password" id="repassword" onkeyup="confVal()">
            <span class="errorMsg" id="confErr" hidden> * password must match</span>
            <br>
            <label for="email">Mail-id : </label>
            <input type="email" name="email" placeholder="email" id="email" >
            
            <br>
            <label for="phone">Phone : </label>
            <input type="tel" name="phone" placeholder="phone" id="phone" onkeyup="confVal()">
            <span class="errorMsg" id="phoneErr" hidden> * phone no required</span>
            <br>
            <input type="submit" value="Submit" class="submit" id="loginSub" disabled name="submit">
            <input type="reset" value="Reset" class="reset">
            <script>
                setInterval(submitBt,1000);
                function submitBt(){
                    var user=document.getElementById("username").value;
                    var pass=document.getElementById("password").value;
                    var conf=document.getElementById("repassword").value;
                    var phone=document.getElementById("phone").value;
                    var submitbtn=document.getElementById("loginSub");
                    //errors
                    var userErr=document.getElementById("userErr");
                    var passErr=document.getElementById("passErr");
                    var confErr=document.getElementById("confErr");
                    var phoneErr=document.getElementById("phoneErr");
                    
                    
                    
                    if(user && pass && conf && phone && pass===conf){
                        submitbtn.disabled=false;
                    }else{
                        submitbtn.disabled=true;
                    }
                    
                }
                var user=document.getElementById("username");
                var pass=document.getElementById("password");
                var conf=document.getElementById("repassword");
                var phone=document.getElementById("phone");
                function confVal() {if(pass.value!=conf.value) confErr.hidden=false; else confErr.hidden=true; }
                function userVal() {if (user.value) userErr.hidden=true; else userErr.hidden=false; }
                function passVal() {if(pass.value) passErr.hidden=true; else passErr.hidden=false;}
                function phoneVal() {if(phone.value) phoneErr.hidden=true; else passErr.hidden=false;}

            </script>
        </form>
    </body>
</html>