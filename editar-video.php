<?php


require_once 'config.php';
$pdo = new PDO('mysql:host=localhost;dbname=aluraplay','root','');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false) {
    header('Location: /index.php');
    exit();
}

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

$sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id';
$statement = $pdo->prepare($sql);
$statement->bindValue(':url', $url);
$statement->bindValue(':title', $titulo);
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();

header('Location: /index.php');