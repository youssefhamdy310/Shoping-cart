<?php

if (isset($_POST['signup'])) {
    session_start();
    include '../includes/connect.php';
    include '../includes/functions.php';
    $_SESSION['username'] = $_POST['signup-username'];
    $_SESSION['password'] = $_POST['signup-password'];
    $_SESSION['email'] = $_POST['signup-email'];
    $_SESSION['confirm'] = $_POST['signup-confirm_password'];
    $username = $_SESSION['username'];
    $password = password_hash($_SESSION['password'], PASSWORD_ARGON2I);
    $email = $_SESSION['email'];
    $confirm = $_SESSION['confirm'];

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` LIKE '$username'");
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    if (strlen($username) > 20) {
        header("location: ../views/signup.php?error=userlong");
        exit();
    } elseif (!empty($result)) {
        header("location: ../views/signup.php?error=usertaken");
        exit();
    } elseif (!notHaveSpecialChars($username)) {
        header("location: ../views/signup.php?error=userhavespecial");
        exit();
    } elseif (!isStrongPassword($password)) {
        header("location: ../views/signup.php?error=passweak");
        exit();
    } elseif ($_SESSION['password'] !== $confirm) {
        header("location: ../views/signup.php?error=passnotconfrm");
        exit();
    } else {
        $sql = $conn->prepare("INSERT INTO `users`( `username`, `email`, `password`) VALUES ('$username','$email','$password')");
        $sql->execute();
        header("location: ../views/home.php");
        exit();
    }
}