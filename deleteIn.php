<?php
    session_start();
    include("./db.php");
    if(empty($_SESSION['user_id'])){
        header("location: login.php");
    }

    $prInID=$_GET['prInId'];
    $delete=mysqli_query($con, "DELETE FROM productin WHERE ProductIn_id='$prInID'");
    if($delete){
        header('Location: viewProductIn.php');
    }
    else{
        echo 'Failed to delete Product from Product In';
    }
?>