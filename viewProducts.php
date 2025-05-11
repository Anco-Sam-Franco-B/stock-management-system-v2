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
        <div class="table-header">
        <h1>View Products</h1>
        </div>
            <div class="table">
            <table>
        <tr>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Product Quantity</th>
            <th>Product Price</th>
            <th>Total Price</th>
            <th>Action</th>
        </tr>
        <?php
            $sql=mysqli_query($con, "SELECT * FROM products");
            while($row=mysqli_fetch_assoc($sql)){
        ?>
        <tr>
            <td><?php echo $row['PCode'] ?></td>
            <td><?php echo $row['PName'] ?></td>
            <td><?php echo $row['PQuantity'] ?></td>
            <td><?php echo $row['PUnit_Price'] ?></td>
            <td><?php echo $row['PTotal_price'] ?></td>
            <td class='action'>
                <a href="productOut.php?PCode=<?php echo $row['PCode'] ?>" class="export">Stock Out</a>
                <a href="update.php?PCode=<?php echo $row['PCode'] ?>" class="edit">Update</a>
                <a href="delete.php?PCode=<?php echo $row['PCode'] ?>" class="delete">Delete</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </table>
            </div>
        </div>
    </div>
</body>
</html>