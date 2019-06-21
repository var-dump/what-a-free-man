<?php
header("Content-Type:text/html;charset=utf-8");
try {
    $PDO = new PDO('mysql:host=localhost;dbname=city', 'root', 'Hoxx3Bd9YqUfGkvBbrDp7');
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}