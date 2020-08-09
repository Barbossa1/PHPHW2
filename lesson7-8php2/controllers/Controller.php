<?php

namespace App\controllers;

use App\engine\App;
use App\services\IRenderer;
use App\services\RendererTmplServices;
use App\services\Request;

abstract class Controller
{
    private $action;
    protected $actionDefault = 'all';

    protected $isClosed = false;

    protected $app;
    protected $request;

    /**
     * Controller constructor.
     * @param App $app
     * @param Request $request
     */
    public function __construct(App $app, Request $request)
    {
        $this->app = $app;
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
        return $this->app->renderer->render($template, $params);
    }

    protected function getId()
    {
        return $this->request->getId();
    }

    protected function getPage()
    {
        return $this->request->getPage();
    }

    protected function toPath($path = '', $msg = '')
    {
        $this->request->toPath($path, $msg);
    }
}