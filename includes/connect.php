<?php


$conn = new mysqli("localhost", "root", "", "shopmart");

if ($conn->connect_error) {
    die("connection failed");
}
