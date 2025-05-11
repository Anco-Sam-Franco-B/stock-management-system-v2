<?php
    session_start();
    include("./db.php");
    if(empty($_SESSION['user_id'])){
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design</title>
    <link rel="stylesheet" href="./assets/b.css">
</head>
<body>
    <div class="container">
        <div class="nav">
            <h1>Quick Menu</h1>
            <nav>
                <ul>
                    <label>Manage</label>
                    <li><a href="product_in.php">Import Product</a></li>
                    <li><a href="viewProducts.php">Products</a></li>
                    <label>Reports</label>
                    <li><a href="viewProductIn.php">Products In</a></li>
                    <li><a href="viewProductOut.php">Products Out</a></li>
                    <label>Daily Report</label>
                    <li><a href="generateReport.php">Generate Report</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
            </nav>
        </div>
        <div class="contents">
            <div class="form-box">
                <div class="form">
                <h1>Product In</h1>
    <form action="" method="post">

        <input type="text" name="code" placeholder="Product Code">
        <input type="text" name="name" placeholder="Product Name">
        <input type="text" name="quantity" placeholder="Product Quantity">
        <input type="text" name="price" placeholder="Unit Price">
        <button name='save'>Save Product</button>
        <?php
            if(isset($_POST['save'])){
                $code=$_POST['code'];
                $name=$_POST['name'];
                $quantity=$_POST['quantity'];
                $price=$_POST['price'];

                //total Price Product in
                $total=$quantity * $price;

                //check products Pcode is equal to code
                $checkStock=mysqli_query($con, "SELECT * FROM products WHERE PCode='$code'");
                $fetchStock=mysqli_fetch_assoc($checkStock);

                //comparing the entry code and code from products table
                if($fetchStock['PCode']===$code){
                    $newQuantity=$fetchStock['PQuantity'] + $quantity;
                    $newTotalPrice=$newQuantity * $fetchStock['PUnit_Price'];

                    //update products table
                    mysqli_query($con, "UPDATE products SET PQuantity='$newQuantity', PTotal_Price='$newTotalPrice' WHERE PCode='$code'");
                }
                else{
                    //when code are not match then take product as new product code
                    mysqli_query($con, "INSERT INTO products VALUES('$code', '$name', '$quantity', '$price', '$total')");
                }

                $import=mysqli_query($con,"INSERT INTO productin VALUES(NULL, '$code', NOW(), '$quantity', '$price', '$total')");
                if($import){
                    header('location: viewProductIn.php');
                }
                else{
                    echo 'Product Not Stocked In!';
                }
            }
        ?>
        </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>