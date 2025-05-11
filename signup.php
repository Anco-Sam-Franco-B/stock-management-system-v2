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
    <title>SignUp | Stock Management</title>
    <link rel="stylesheet" href="./assets/login.css">
</head>
<body>
    <div class="container">
    <form action="" method="post">
    <h1>SignUp</h1>
        <input type="text" name="username" placeholder="UserName">
        <input type="password" name="password" placeholder="Password">
        <button name="create">Signup</button>
        <p>I Alreay signed in, <a href="login.php">Login?</a></p>
    </form>
    <?php
        if(isset($_POST['create'])){
            $username=$_POST['username'];
            $password=$_POST['password'];
            $hashPassword=md5($password);
            
            //insert new account table users
            $sql=mysqli_query($con, "INSERT INTO users VALUES(NULL, '$username', '$hashPassword')");
            if($sql){
                echo 'User account created. Now you can login!';
            }
            else{
                echo "Failed to create user account";
            }
        }
    ?>
    </div>
</body>
</html>