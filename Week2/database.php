<?php
    $db = 'winkel';
    $user = 'root';
    $pass = '';
    $host = 'localhost:3307';

    $dsn = "mysql:host=$host;dbname=$db;";

    try {
        $pdo = new PDO($dsn, $user, $pass);
        echo 'Connection successfull with the database ' . $db;
    } catch (PDOException $e) {
        throw new \PDOException($e->getMessage());
    }
?>