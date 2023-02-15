<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class NewVideoController implements Controller
{
    public function __construct(private readonly VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false) {
            $_SESSION['erro_message'] = 'URL inválida';
            header('Location: /novo-video');
            return;
        }
        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            $_SESSION['erro_message'] = 'Título não informado';
            header('Location: /novo-video');
            return;
        }
        $video = new Video($url, $titulo);

        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                __DIR__ . '/../../public/img/uploads/' .$_FILES['image']['name']
            );
            $video->setFilePath($_FILES['image']['name']);
        }

        $success = $this->videoRepository->add($video);
        if ($success === false) {
            $_SESSION['erro_message'] = 'Erro ao inserir novo vídeo';
            header('Location: /novo-video');
        } else {

            header('Location: /');
        }
    }
}
