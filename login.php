<?php
    session_start();
    include("./db.php");
    if(isset($_SESSION['user_id'])){
        header("location: viewProducts.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Stock Management</title>
    <link rel="stylesheet" href="./assets/login.css">
</head>
<body>
<div class="container">
    <form action="" method="post">
     <h1>Login</h1>
        <input type="text" name="username" placeholder="UserName">
        <input type="password" name="password" placeholder="Password">
        <button name="login">Login</button>
        <p>I Alreay not signed in, <a href="signup.php">Create Account?</a></p>
        <?php
            if(isset($_POST['login'])){
                $username=$_POST['username'];
                $password=$_POST['password'];
                $hashPassword=md5($password);

                //seclect username and password if they are match
                $sql=mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$hashPassword'");
                $fetch=mysqli_fetch_assoc($sql);
                if(mysqli_num_rows($sql)>0){
                    if($sql){
                        $_SESSION['user_info']= $username;
                        $_SESSION['user_id']= $fetch['UserId'];
                        echo '<script>
                            alert("Login Success!");
                        </script>';
                        header("location: viewProducts.php");
                    }
                    else{
                        echo 'Login Failed';
                    }
                }
                else{
                    echo 'User Account doesn\'t created! try to signup inoder to login!';
                }
            }
        
        ?>
    </form>
</div>
</body>
</html>