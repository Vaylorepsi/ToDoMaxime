<?php
$host = 'localhost';
$dbname = 'todo';
$username = 'root';
$password = '';

try{
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
    $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOExecption $e) {
    die("Erreur de connexion : " . $e->getmessage());
}
?>