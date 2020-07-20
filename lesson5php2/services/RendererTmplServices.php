<?php

namespace App\services;

class RendererTmplServices implements IRenderer
{
    public function render($template, $params = [])
    {
        $content = $this->rendererTmpl($template, $params);
        return $this->rendererTmpl(
            'layouts/main',
            [
                'content' => $content
            ]
        );
    }

    public function rendererTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}