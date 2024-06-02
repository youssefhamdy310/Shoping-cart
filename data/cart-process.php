<?php

if (isset($_POST['submit'])) {
    include '../includes/connect.php';
    $id = $_POST['pid'];
    $name = $_POST['pname'];
    $price = $_POST['pprice'];
    $img = $_POST['ppic'];
    
    $sql = $conn->prepare("SELECT * FROM cart WHERE `product_name` LIKE '$name'");
    $sql->execute();
    $result = $sql->get_result();
    if (mysqli_num_rows($result) > 0) {
        header("location: ../views/home.php?error=found");
        exit();
    }  else {
        $sql = $conn->prepare("INSERT INTO `cart`( `product_name`, `product_price`, `total_price`,`product_pic`, `qty`) VALUES ('$name', '$price', '$price','$img','1')");
        $sql->execute();
        header("location: ../views/home.php?error=done");
        exit();
    }
}