<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'database_shop';
$port = '3306';
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_errno) {
    die("gagal connect : " . $conn->connect_error);
}
?>