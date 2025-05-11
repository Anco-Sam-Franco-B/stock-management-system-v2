<?php
    session_start();
    include("./db.php");
    if(empty($_SESSION['user_id'])){
        header("location: login.php");
    }

    $prOutID=$_GET['prOutId'];
    $delete=mysqli_query($con, "DELETE FROM productout WHERE ProductOut_id='$prOutID'");
    if($delete){
        header('Location: viewProductOut.php');
    }
    else{
        echo 'Failed to delete Product from Product ';
    }
?>