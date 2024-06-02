<?php

function isStrongPassword($password) {
    // Minimum length requirement
    if (strlen($password) < 8) {
        return false;
    }

    // Check for at least one uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    // Check for at least one lowercase letter
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    // Check for at least one digit
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }

    // Check for at least one special character
    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        return false;
    }

    // If all checks pass, return true
    return true;
}

function notHaveSpecialChars($username) {
    // Check if the username consists only of alphanumeric characters
    if (preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        return true;
    } else {
        return false;
    }
}