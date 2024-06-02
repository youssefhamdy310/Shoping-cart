
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    include '../includes/connect.php';

    $sql = $conn->prepare("SELECT * FROM orders");
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    ?>
    <h1>YOUR ORDER IS PLACED SUCCFULLY</h1>
    <p>Name : <?= $row['name'] ?></p>
    <p>Adress : <?= $row['address'] ?></p>
    <p>OrderNumber : <?= $row['id'] ?></p>
    <p>THANK YOU</p>
    <?php  ?>
</body>
</html>