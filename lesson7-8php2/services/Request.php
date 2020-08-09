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
        session_start();
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

    public function post($key = '', $defaultValue = null)
    {
        return $this->getDataByKey('post', $key, $defaultValue);
    }

    public function get($key = '', $defaultValue = null)
    {
        return $this->getDataByKey('get', $key, $defaultValue);
    }

    public function getSession($key = '', $defaultValue = null)
    {
        if (empty($key)) {
            return $_SESSION;
        }

        if (!empty($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return $defaultValue;
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    protected function getDataByKey($params, $key = '', $defaultValue = null)
    {
        if (empty($key)) {
            return $this->params[$params];
        }

        if (!empty($this->params[$params][$key])) {
            return $this->params[$params][$key];
        }

        return $defaultValue;
    }

    public function toPath($path = '', $msg = '')
    {
        if (!empty($msg)) {
            $this->setSession('msg', $msg);
        }

        if (!empty($path)) {
            header("Location: {$path}");
            return;
        }

        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: {$_SERVER['HTTP_REFERER']}");
            return;
        }

        header('Location: /');
    }

    public function getResponse($data)
    {
        header('Content-Type: application/json');
        return json_encode($data);
    }

}