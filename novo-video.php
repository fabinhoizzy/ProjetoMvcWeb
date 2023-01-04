<?php

require_once 'config.php';
$pdo = new PDO('mysql:host=localhost;dbname=aluraplay','root','');

$sql = "INSERT INTO videos (url, title) VALUES (?, ?)";
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $_POST['url']);
$statement->bindValue(2, $_POST['titulo']);

$statement->execute();

header('Location: /aluraplay/index.php');

