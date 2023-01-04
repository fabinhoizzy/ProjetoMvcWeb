<?php

require_once 'config.php';
$pdo = new PDO('mysql:host=localhost;dbname=aluraplay','root','');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$sql = 'DELETE FROM videos WHERE id = ?';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $id);
$statement->execute();

header('Location: /index.php');

