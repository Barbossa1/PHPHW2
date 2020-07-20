<?php

namespace App\services;

class TwigRendererServices implements IRenderer
{
    /**
     * @var \Twig\Environment
     */
    protected $twig;

    public function render($template, $params = [])
    {
        return $this->twig->render($template, $params);
    }
}