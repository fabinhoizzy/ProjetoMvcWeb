<?php

require_once 'config.php';
$pdo = new PDO('mysql:host=localhost;dbname=aluraplay','root','');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$video = [
  'url' => '',
  'title' => ''
];
if($id !== false) {
    $statement = $pdo->prepare('SELECT * FROM videos WHERE id = ?;');
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    $statement->execute();
    $video = $statement->fetch(\PDO::FETCH_ASSOC);
}



$videoList = $pdo->query('SELECT * FROM videos;')->fetchAll(\PDO::FETCH_ASSOC);

?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/estilos-form.css">
    <link rel="stylesheet" href="../css/flexbox.css">
    <title>AluraPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>

<!-- Cabecalho -->
<header>

    <nav class="cabecalho">
        <a class="logo" href="/"></a>

        <div class="cabecalho__icones">
            <a href="enviar-video.php" class="cabecalho__videos"></a>
            <a href="../pages/login.html" class="cabecalho__sair">Sair</a>
        </div>
    </nav>

</header>

<main class="container">

    <form class="container__formulario"
          action="<?= $id !== false ? '/editar-video.php?id=' . $id : '/novo-video.php'; ?>"
          method="post">
        <h2 class="formulario__titulo">Editar um vídeo!</h2>
        <div class="formulario__campo">
            <label class="campo__etiqueta" for="url">Link embed</label>
            <input name="url" class="campo__escrita" required value="<?= $video['url']?>" id='url' />
        </div>


        <div class="formulario__campo">
            <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
            <input name="titulo" class="campo__escrita" required value="<?= $video['title']?>"
                   id='titulo' />
        </div>

        <input class="formulario__botao" type="submit" value="Editar" />
    </form>

</main>

</body>

</html>
