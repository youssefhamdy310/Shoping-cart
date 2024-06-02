<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopMart - Login</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
    <?php include '../includes/header.html'; ?>
    <main class="login-page">
        <div class="login-container">
            <h1>Login</h1>
            <form action="../data/login-process.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="login-username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="login-password" required>
                </div>
                <button type="submit" name="login" class="btn">Login</button>
            </form>
            <?php 
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "wrongpass") {
                    echo '<p style="color: red;">Password is incorrect</p>';
                } elseif ($_GET['error'] == "wrongemail") {
                    echo '<p style="color: red;">Username is incorrect</p>';
                }
            }
                
                
                
                ?>
            <!-- <p style="color: red;">Password is incorrect</p> -->
        </div>
    </main>
    <?php include '../includes/footer.php' ?>
</body>
</html>
