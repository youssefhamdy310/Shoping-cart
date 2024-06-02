<?php
session_start();
include '../includes/connect.php';
$sql = $conn->prepare("SELECT total_price FROM cart WHERE 1=1");
$sql->execute();
$result = $sql->get_result();
$prices = [];
while ($row = $result->fetch_assoc()) {
    $prices []= $row['total_price']; 
}
$total = array_sum($prices);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/cart.css">
    <title>Document</title>
</head>
<body>
    <?php include '../includes/header.html' ?>
    <main>
    <h1>Your Shopping Cart</h1>
    <table class="cart-table">
            <thead>
                <tr>
                    <th>Item Image</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example row -->
                <!-- <tr>
                    <td>1</td>
                    <td>Product A</td>
                    <td>$10.00</td>
                    <td>2</td>
                    <td>
                        <button class="btn add-btn">Add</button>
                        <button class="btn delete-btn">Delete</button>
                    </td>
                </tr> -->
                <!-- More rows as needed -->
                <?php
                $sql = $conn->prepare("SELECT * FROM cart");
                $sql->execute();
                $result = $sql->get_result();
                while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <form action="../data/cart-edit.php" method="POST">
                    <td><img src="<?= $row['product_pic'] ?>" width="50px" height="50px" alt=""></td>
                    <td><?= $row['product_name'] ?></td>
                    <input type="text" hidden name="pname" value="<?= $row['product_name'] ?>">
                    <input type="text" hidden name="pqty" value="<?php $qty = $row['qty']; echo $qty ?>">
                    <td>$<?= $row['product_price'] ?></td>
                    <td><input type="submit" class="minus" name="minus" value="-"><?= $qty ?><input class="add" type="submit" name="add" value="+"></td>
                    <!-- <input type="submit" name="add" value="+"> -->
                    <input type="text" hidden name="pprice" value="<?php $qty = $row['product_price']; echo $qty ?>">
                    <td>$<?= $row['total_price'] ?></td>
                    <td>
                        <!-- <button type="submit"  name="add" class="btn add-btn">Add</button> -->
                        <!-- <button type="submit" name="delete" class="btn delete-btn">Delete</button> -->
                        <input type="submit" class="delete" name="delete" value="Remove">
                    </td>
                </tr>
                <?php } ?>
                <tr class="total-row">
                    <td colspan="2"><a class="continue" href="home.php">Continue shoping</a></td>
                    <td colspan="2">Total</td>
                    <td >$<?= $total ?></td>
                    <td style="background-color: #fff;"><input type="submit" name="conpur" class="confirm" value="Confirm Purchase"></td>
                </form>
                </tr>
                </tbody>
            </table>
        </main>
        <?php include '../includes/footer.php' ?>
    </body>
    </html>