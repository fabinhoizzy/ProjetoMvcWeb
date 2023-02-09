<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=aluraplay', 'root', 'izzyroot');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
