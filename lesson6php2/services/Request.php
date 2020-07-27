<?php

namespace App\services;

use Throwable;

class Request
{
    private $requestString = '';
    private $controllerName = 'good';
    private $actionName = '';
    private $id = 0;
    private $page = 1;
    private $params = [
        'get' => array(),
        'post' => array(),
        'session' => array(),
    ];

    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->prepareRequest();
    }

    protected function prepareRequest()
    {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";

        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];
        }

        $this->params = [
            'get' => $_GET,
            'post' => $_POST,
            'session' => $_SESSION,
        ];

        if (!empty((int)$_GET['id'])) {
            $this->id = (int)$_GET['id'];
        }

        if (!empty((int)$_GET['page'])) {
            $this->page = (int)$_GET['page'];
        }
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return  'App\\controllers\\' . ucfirst($this->controllerName) . 'Controller';
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    public function post($value = '')
    {
        if (empty($value)) {
            return $this->params['post'];
        }
        return $this->params['post'][$value];
    }

}