<?php

if(isset($_POST['order'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $cardName = $_POST['card-name'];
    $cardNumber = $_POST['card-number'];
    $expDate = $_POST['exp-date'];
    $cvv = $_POST['cvv'];
    $phone = $_POST['phone'];

    include '../includes/connect.php';
    $items = "";
    $sql = $conn->prepare("SELECT CONCAT(product_name, '(', qty, ')') AS items,total_price FROM cart");
    $sql->execute();
    $result = $sql->get_result();
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $items .= $row['items'];
        $total += $row['total_price'];
    }
    $sql = $conn->prepare("INSERT INTO `orders`(`name`, `email`, `phone`, `address`, `card_name`, `card_number`, `cvv`, `products`, `amount_paid`)VALUES ('$name','$email','$phone','$address','$cardName','$cardNumber','$cvv', '$items', '$total')");
    $sql->execute();
    $sql = $conn->prepare("DROP TABLE cart");
    $sql->execute();
    $sql = $conn->prepare("CREATE TABLE `cart` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `product_name` varchar(100) NOT NULL,
        `product_price` varchar(50) NOT NULL,
        `total_price` varchar(25) NOT NULL,
        `product_pic` varchar(255) NOT NULL,
        `qty` int(10) NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
    $sql->execute();
    header("location: ../views/done.php");
    exit();
}