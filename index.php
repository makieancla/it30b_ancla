<?php
// Database connection
$host = 'localhost';
$db = 'it30b_lab_db';
$user = 'root';
$password = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try{
    $pdo = new PDO($dsn, $user, $password, $options);
    echo 'connection successful';
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$action = $_GET['action'] ?? '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System</title>
</head>
<body>
    <h1>Simple Library System</h1>
</nav>
    <a href="index.php?section=students">Students</a> |
    <a href="index.php?section=books">Books</a> |
    <a href="index.php?section=borrow">Borrow</a> |
    <
</html>