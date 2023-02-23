<?php

namespace Alura\Mvc\Helper;

trait FlashMessageTrait
{
    private function addErroMessage(string $erroMessage): void
    {
        $_SESSION['erro_message'] = $erroMessage;
    }
}