<?php
$host = "localhost";
$dbname = "testdb_datatable";
$dsn = "mysql:host=$host;dbname=$dbname";
$username = "root";
$password = "12345678";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>