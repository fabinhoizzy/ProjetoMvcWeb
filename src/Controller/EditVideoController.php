<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EditVideoController implements RequestHandlerInterface
{

    use FlashMessageTrait;

    public function __construct(private readonly VideoRepository $videoRepository)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams('id'), FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            return new Response(302,  [
                'Location' => '/'
            ]);
        }

        $url = filter_var($queryParams ('url'), FILTER_VALIDATE_URL);
        if ($url === false) {
            return new Response(302,  [
                'Location' => '/'
            ]);
        }

        $titulo = filter_var($queryParams('titulo'), INPUT_POST);
        if ($titulo === false) {
            return new Response(302,  [
                'Location' => '/'
            ]);
        }
        
        $video = new Video($url, $titulo);
        $video->setId($id);

        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                __DIR__ . '/../../public/img/uploads' .$_FILES['image']['name']
            );
            $video->setFilePath($_FILES['image']['name']);
        }

        $success = $this->videoRepository->update($video);

        if ($success === false) {
            $this->addErroMessage('Erro ao alterar o vídeo');
            return new Response(302,  [
                'Location' => '/'
            ]);
        } else {
            return new Response(302,  [
                'Location' => '/'
            ]);
        }
    }
}