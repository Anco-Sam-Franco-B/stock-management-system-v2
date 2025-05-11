<?php
    session_start();
    include("./db.php");
    if(empty($_SESSION['user_id'])){
        header("location: login.php");
    }

    $PCode=$_GET['PCode'];
    $delete=mysqli_query($con, "DELETE FROM products WHERE PCode='$PCode'");
    if($delete){
        header('Location: viewProducts.php');
    }
    else{
        echo 'Failed to delete Product from Products';
    }
?>