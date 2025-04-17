<?php
// app/api/db_connect.php
$host     = '127.0.0.1';
$database = 'qanda_db';
$user     = 'root';
$pass     = 'Root2024';   // ← use the same password you entered at mysql> 

$conn = new mysqli($host, $user, $pass, $database);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
