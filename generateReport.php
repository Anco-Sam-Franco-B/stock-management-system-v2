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
        <div class="form">
        <form action="" method="post">
            <h1>Generate Report</h1>
            <label>Report Date</label>
            <input type="date" name="from-date">
            <button name='generate'>Generate Report</button>
        </form>
        </div>
    <?php
        if(isset($_POST['generate'])){
            $from=$_POST['from-date'];
            if($from!=""){
            $sql=mysqli_query($con, "SELECT * FROM productin WHERE prIn_Date='$from'");
            if(mysqli_num_rows($sql)>0){
    ?>
    
    <div class="table-header">
        <h1>Stock Status Report Based on the Product In on <?php echo $from ?></h1>
        <a href="printReport.php?date=<?php echo $from ?>">Print Report</a>
    </div>
    <div class="table">
    <table>
        <tr>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Product In Date</th>
            <th>Product Quantity</th>
            <th>Product Price</th>
            <th>Total Price</th>
            <th>Action</th>
        </tr>
        <?php
            while($row=mysqli_fetch_assoc($sql)){
                $code=$row['PCode'];
                $selectProducts=mysqli_query($con, "SELECT * FROM products WHERE PCode='$code'");
                while($proRow=mysqli_fetch_assoc($selectProducts)){
        ?>
        <tr>
            <td><?php echo $row['PCode'] ?></td>
            <td><?php echo $proRow['PName'] ?></td>
            <td><?php echo $row['prIn_Date'] ?></td>
            <td><?php echo $row['prIn_Quantity'] ?></td>
            <td><?php echo $row['prIn_Unit_price'] ?></td>
            <td><?php echo $row['prIn_Totalprice'] ?></td>
            <td>
                <a href="deleteIn.php?prInId=<?php echo $row['ProductIn_id'] ?>" class="delete">Delete</a>
            </td>
        </tr>
        <?php
            }
        }
        ?>
    </table>
    </div>
    <?php
            }
            else{
    ?>
        <div class="error">
             <h1>No Report Status on this date <?php echo $from ?></h1>
        </div>
    <?php
            }
        }
        else{
            ?>
                <div class="error">
                    <h1>Invalid Report Date</h1>
                </div>
            <?php
        }
    }
    ?>
        </div>
    </div>
</body>
</html>