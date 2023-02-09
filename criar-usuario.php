<?php

require_once __DIR__ . '/config.php';
$pdo = new PDO('mysql:host=localhost;dbname=aluraplay','root','izzyroot');

$email = $argv[1];
$password = $argv[2];
$hash = password_hash($password, PASSWORD_ARGON2ID);

$sql = 'INSERT INTO users (email, password) VALUES(?, ?);';
$pdo->prepare($sql);
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $email);
$statement->bindValue(2, $hash);
$statement->execute();