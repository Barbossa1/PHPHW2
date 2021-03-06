<?php

namespace App\controllers;

use App\models\User;

class UserController
{
    private $action;
    protected $actionDefault = 'all';

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

    public function allAction()
    {
        return $this->render(
            'users',
            [
                'users' => User::getAll(),
            ]
        );
    }

    public function oneAction()
    {
        $id = $this->getId();
        return $this->render(
            'user',
            [
                'user' => User::getOne($id),
            ]
        );
    }

    public function delAction()
    {
        $id = $this->getId();
        header('Location: /public/?c=user&a=all');
        return $this->render(
            'user',
            [
                'user' => User::delete($id),
            ]
        );
    }

    protected function getId()
    {
        $id = 0;
        if (!empty((int)$_GET['id'])) {
            $id = (int)$_GET['id'];
        }

        return $id;
    }

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