<?php

namespace Alura\Mvc\Controller;

abstract class ControllerWithHtml implements Controller
{
    private const TEMPLATE_PATH = __DIR__ . '/../../views/';

    public function renderTemplate(string $templeteName, array $context = []): string
    {
        extract($context);

        ob_start();
        require_once self::TEMPLATE_PATH . $templeteName . '.php';
        return ob_get_clean();
    }
}