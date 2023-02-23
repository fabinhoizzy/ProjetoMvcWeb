<?php

namespace Alura\Mvc\Helper;

trait HtmlRenderTrait
{
    private function renderTemplate(string $templeteName, array $context = []): string
    {
        $templetePath = __DIR__ . '/../../views/';
        extract($context);

        ob_start();
        require_once $templetePath . $templeteName . '.php';
        return ob_get_clean();
    }
}