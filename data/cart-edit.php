<?php

if (isset($_POST['delete'])) {
    include '../includes/connect.php';
    $name = $_POST['pname'];
    $sql = $conn->prepare("DELETE FROM cart WHERE `product_name` LIKE '$name'");
    $sql->execute();
    header("location: ../views/cart.php");
    exit();
} elseif (isset($_POST['add'])) {
    include '../includes/connect.php';
    $price = $_POST['pprice'];
    $name = $_POST['pname'];
    $qty = $_POST['pqty'];
    $qty++;
    $after = $price * $qty;
    $sql = $conn->prepare("UPDATE `cart` SET `qty`='$qty' WHERE product_name LIKE '$name'");
    $sql->execute();
    $sql = $conn->prepare("UPDATE `cart` SET `total_price`='$after' WHERE product_name LIKE '$name'");
    $sql->execute();
    header("location: ../views/cart.php");
    exit();

} elseif(isset($_POST['minus'])) {
    include '../includes/connect.php';
    $price = $_POST['pprice'];
    $name = $_POST['pname'];
    $qty = $_POST['pqty'];
    $qty--;
    if ($qty == 0) {
    include '../includes/connect.php';
    $name = $_POST['pname'];
    $sql = $conn->prepare("DELETE FROM cart WHERE `product_name` LIKE '$name'");
    $sql->execute();
    header("location: ../views/cart.php");
    exit();
    } elseif ($qty < 0) {
        header("location: ../view/cart.php?error=cannotminus");
        exit();
    }
    $after = $price * $qty;
    $sql = $conn->prepare("UPDATE `cart` SET `qty`='$qty' WHERE product_name LIKE '$name'");
    $sql->execute();
    $sql = $conn->prepare("UPDATE `cart` SET `total_price`='$after' WHERE product_name LIKE '$name'");
    $sql->execute();
    header("location: ../views/cart.php");
    exit();
} elseif (isset($_POST['conpur'])) {
    include '../includes/connect.php';
    $sql = 'SELECT CONCAT(product_name, "(", qty, ")" ) AS items, total_price FROM `cart`;';
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->get_result();
    $items = "";
    $totalMoney = 0;
    while ($row = $result->fetch_assoc()) {
        $items .= $row['items'] . " ";
        $totalMoney += $row['total_price'];
    }
}?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- <link rel="stylesheet" href="styles/styles.css"> -->
    <link rel="stylesheet" href="../styles/checkout.css"> <!-- Link the checkout CSS file -->
</head>
<body>
    <?php include '../includes/header.html'; ?>

    <main class="checkout-container">
        <h1>Checkout</h1>
        <p class="items">Items : <?= $items ?></p>
        <p class="total">Grand Total : $<?= $totalMoney ?></p>
        <form class="checkout-form" method="post" action="checkout-process.php">
            <div class="billing-details">
                <h2>Billing Details</h2>

                <label for="name">Name</label>
                <input type="name"  id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email"  id="email" name="email" required>

                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>

                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" required>

            </div>

            <div class="payment-details">
                <h2>Payment Details</h2>
                <label for="card-name">Name on Card</label>
                <input type="text" id="card-name" name="card-name" required>

                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" name="card-number" required>

                <label for="exp-date">Expiration Date</label>
                <input type="text" id="exp-date" name="exp-date" placeholder="MM/YY" required>

                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>

            <button type="submit" name="order" class="checkout-button">Place Order</button>
        </form>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>

