<?php

if (isset($_POST['login'])) {
    session_start();
    include '../includes/connect.php';
    $_SESSION['username'] = $_POST['login-username'];
    $_SESSION['password'] = $_POST['login-password'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    if ($username == "Admin310" && $password == "Admin310") {
        $_SESSION['username'] = "ADMIN";
        header('location: ../views/home.php');
        exit();
    } 

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` LIKE '$username'");
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    if ($result['password'] == $_SESSION['password']) {
        header('location: ../views/home.php');
        exit();
    } elseif (empty($result)) {
        header("location: ../views/login.php?error=wrongemail");
        exit();
    } elseif (password_verify($result['password'], $password)) {
        header("location: ../views/login.php?error=wrongpass");
        exit();
    } 
}