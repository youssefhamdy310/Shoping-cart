<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopMart - Sign Up</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="../styles/signup.css">
</head>
<body>
    <?php include '../includes/header.html'; ?>
    <main class="signup-page">
        <div class="signup-container">
            <h1>Sign Up</h1>
            <form action="../data/signup-process.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="signup-username" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Email:</label>
                    <input type="email" id="email" name="signup-email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="signup-password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="signup-confirm_password" required>
                </div>
                <button type="submit" name="signup" class="btn">Sign Up</button>
            </form>
            
            <?php 
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "userlong") {
                    echo '<p style="color: red;">Username must be<br/>less than  20 characters</p>';
                } elseif ($_GET['error'] == "usertaken") {
                    echo '<p style="color: red;">Username is already taken</p>';
                } elseif ($_GET['error'] == "userhavespecial") {
                    echo '<p style="color: red;">Username must not<br/>have special characters</p>';
                } elseif ($_GET['error'] == "passweak") {
                    echo '<p style="color: red;">Password is weak</p>';
                } elseif ($_GET['error'] == "passnotconfrm") {
                    echo '<p style="color: red;">Password doesnt<br/>match confirm password</p>';
                }
            }
            ?>
        </div>
    </main>
    <?php include '../includes/footer.php' ?>
</body>
</html>
