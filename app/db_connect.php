<?php
require_once __DIR__ . '/db_config.php';
$conn = new mysqli($host, $user, $pass, $database);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
