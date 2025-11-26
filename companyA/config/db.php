<?php
$host = 'localhost';
$dbname = 'company_a_db';
$username = 'root';
$password = 'Hannohinrich@12';

$pdo = null;
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Don't exit - let the page handle the error gracefully
    $pdo = null;
}
?>