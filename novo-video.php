<?php

require_once 'config.php';
$pdo = new PDO('mysql:host=localhost;dbname=aluraplay','root','');

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false){
    header('Location: /index.php');
    exit();
}
$titulo = filter_input(INPUT_POST,'titulo');
if ($titulo === false) {
    header('Location: /index.php');
    exit();
}

$sql = "INSERT INTO videos (url, title) VALUES (?, ?)";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $url);
$statement->bindValue(2, $titulo);

$statement->execute();

header('Location: /index.php');

