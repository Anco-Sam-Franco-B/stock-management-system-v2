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
        <h1>Product Out</h1>
<?php
        $Code=$_GET['PCode'];
        $sql=mysqli_query($con, "SELECT * FROM products WHERE PCode='$Code'");
        while($row=mysqli_fetch_assoc($sql)){
    ?>
        <form action="" method="post">
            <input type="text" value="<?php echo  $row['PCode'] ?>" name="code" placeholder="Product Code">
            <input type="text" value="<?php echo  $row['PName'] ?>" name="name" placeholder="Product Name">
            <input type="text" value="<?php echo  $row['PQuantity'] ?>" name="quantity" placeholder="Product Quantity">
            <input type="text" value="<?php echo  $row['PUnit_Price'] ?>" name="price" placeholder="Unit Price">
            <button name='out'>Product Out</button>
        </form>
    <?php
        }
        if(isset($_POST['out'])){
            $code=$_POST['code'];
            $name=$_POST['name'];
            $quantity=$_POST['quantity'];
            $price=$_POST['price'];

            $select=mysqli_query($con, "SELECT * FROM products WHERE PCode='$Code'");
            $fetchProduct=mysqli_fetch_assoc($select);

            //limitation 
            if($fetchProduct['PQuantity']!=0 && $fetchProduct['PQuantity']>=$quantity && $quantity!=0){
                //formulas products
                $remainQuantity=$fetchProduct['PQuantity'] - $quantity;
                $newTotalPrice=$remainQuantity *  $price;

                //furmula product Out
                $totalPriceOut=$quantity * $price;

                //udpate Products Table
                mysqli_query($con, "UPDATE products SET PQuantity='$remainQuantity', PTotal_price='$newTotalPrice' WHERE PCode='$code'");
                //Insert into productOut
                $export=mysqli_query($con,"INSERT INTO productout VALUES(NULL, '$code', NOW(), '$quantity', '$price', '$totalPriceOut')");
                if($export){
                    header('location: viewProducts.php');
                }
                else{
                    echo 'Product Not Stocked Out!';
                }

            }
            else{
                echo "Product must be equal or less than to product quantity in Stock";
            }
        }
    ?>
        </div>
        </div>
        </div>
    </div>
</body>
</html>