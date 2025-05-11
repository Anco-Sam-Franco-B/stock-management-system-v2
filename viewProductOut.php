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
            <h1>View Product In</h1>
        </div>
        <div class="table">
        <table>
        <tr>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Product Out Date</th>
            <th>Product Quantity</th>
            <th>Product Price</th>
            <th>Total Price</th>
            <th>Action</th>
        </tr>
        <?php
            $sql=mysqli_query($con, "SELECT * FROM productout");
            while($row=mysqli_fetch_assoc($sql)){
                $code=$row['PCode'];
                $selectProducts=mysqli_query($con, "SELECT * FROM products WHERE Pcode='$code'");
                while($prRow=mysqli_fetch_assoc($selectProducts)){
        ?>
        <tr>
            <td><?php echo $row['PCode'] ?></td>
            <td><?php echo $prRow['PName'] ?></td>
            <td><?php echo $row['prOut_Date'] ?></td>
            <td><?php echo $row['prOut_Quantity'] ?></td>
            <td><?php echo $row['prOut_Unit_price'] ?></td>
            <td><?php echo $row['prOut_Totalprice'] ?></td>
            <td class="action">
                <a href="deleteOut.php?prOutId=<?php echo $row['ProductOut_id'] ?>" class="delete">Delete</a>
            </td>
        </tr>
        <?php
            }
        }
        ?>
    </table>
        </div>
        </div>
    </div>
</body>
</html>