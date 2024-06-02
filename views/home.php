<?php
session_start();
if (isset($_SESSION['username'])){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/home.css">
        <title>ShopMart - Home</title>
    </head>
    <body>
        <?php include '../includes/header.html' ?>
        <main>
        <h1>Shopping List</h1>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "done") {
                echo '<p class="cart-state">item added succesfully</p>';
            } else {
                echo '<p class="cart-state-bad">item already in cart</p>';
            }
        }
        ?>
        <div class="product-list">
            <?php
            include '../includes/connect.php';
            $sql = $conn->prepare("SELECT * FROM products");
            $sql->execute();
            $result = $sql->get_result();
            // $num = 0;
            while ($row = $result->fetch_assoc()) {
                ?>
            <div class="product">
                <img src="<?= $row['product_pic'] ?>" height="250px" alt="Product Image">
                <h3 class="prod-name"><?= $row['product_name'] ?></h3>
                <p><?= number_format($row['product_price'], 0) ?> EGP</p>
                <form action="../data/cart-process.php" method="post" class="form-prod">
                    <input type="text" name="pid" hidden value="<?= $row['id'] ?>">
                    <input type="text" name="pname" hidden value="<?= $row['product_name'] ?>">
                    <input type="text" name="pprice" hidden value="<?= $row['product_price'] ?>">
                    <input type="text" name="ppic" hidden value="<?= $row['product_pic'] ?>">
                    <input type="text" name="pcode" hidden value="<?= $row['product_code'] ?>">
                    <input type="submit" name="submit" class="submit" value="Add to cart">
                </form>
            </div>
            <?php 
            } $sql = $conn->prepare("SELECT * FROM cart");
            $sql->execute();
            $result = $sql->get_result();
            $num = mysqli_num_rows($result); 
            ?>
        </div>
        <!-- <hr> -->
        <div class="cart-icon">
            <a href="cart.php" title="Shopping cart"><?php echo $num == 0 ? "" : '<span name="cart-item" id="cart-item" class="badge">' . $num . '</span>'?></a>
        </div>
        <?php include '../includes/footer.php' ?>
    </main>
</body>
</html>
<?php } else {
    ECHO "ERROR404 - PAGE NOT FOUND";
} ?>
<!-- Display trending items dynamically here -->
<!-- <div class="product">
    <img src="../images/prod1.png" alt="Product Image">
    <h3 class="prod-name">Jabra</h3>
    <p>9500</p>
    <button>Add to Cart</button>
</div> -->
<!-- Repeat for each trending item -->