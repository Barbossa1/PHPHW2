<?php

namespace App\services;

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class TwigRendererServices implements IRenderer
{
    protected $twig;

    /**
     * TwigRendererServices constructor.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader([
            dirname(__DIR__ ) . '/views',
            dirname(__DIR__) . '/views/layouts',
        ]);
        $this->twig = new Environment(
            $loader,
            [
                'debug' => true,
            ]
        );
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    /**
     * @param $template
     * @param array $params
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render($template, $params = [])
    {
        $template .= '.twig';
        try {
            return $this->twig->render($template, $params);
        } catch (\Exception $exception) {
            return    $exception->getMessage();
        }
    }
}