<?php

namespace App\controllers;


use App\services\IRenderer;
use App\services\RendererTmplServices;
use App\services\Request;

abstract class Controller
{
    private $action;
    protected $actionDefault = 'all';

    protected $renderer;
    protected $request;

    /**
     * Controller constructor.
     * @param IRenderer $renderer
     * @param Request $request
     */
    public function __construct(IRenderer $renderer, Request $request)
    {
        $this->renderer = $renderer;
        $this->request = $request;
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
        return $this->request->getId();
    }

    protected function getPage()
    {
        return $this->request->getPage();
    }
}