<?php

namespace App\controllers;

use App\services\IRenderer;
use App\services\RendererTmplServices;

class Controller
{
    private $action;
    protected $actionDefault = 'all';

    protected $renderer;

    /**
     * Controller constructor.
     * @param $renderer
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function run($action)
    {
        $this->action = $action;
        if (empty($this->action)) {
            $this->action = $this->actionDefault;
        }

        $method = $this->action . "Action";
        if (!method_exists($this, $method)) {
            return 'Error';
        }

        return $this->$method();
    }

    public function render($template, $params = [])
    {
        return $this->renderer->render($template, $params);
    }

    protected function getId()
    {
        $id = 0;
        if (!empty((int)$_GET['id'])) {
            $id = (int)$_GET['id'];
        }

        return $id;
    }

    protected function getPage()
    {
        $page = 1;
        if (!empty((int)$_GET['page'])) {
            $page = (int)$_GET['page'];
        }

        return $page;
    }
}