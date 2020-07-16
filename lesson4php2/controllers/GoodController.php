<?php

namespace App\controllers;

use App\models\Good;
use App\services\DB;

class GoodController
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
            'goods',
            [
                'goods' => Good::getAll(),
            ]
        );
    }

    public function oneAction()
    {
        $id = $this->getId();
        return $this->render(
            'good',
            [
                'good' => Good::getOne($id),
            ]
        );
    }

    public function delAction()
    {
        $id = $this->getId();
        //header('Location: /public/?c=good&a=all');
        return $this->render(
            'good',
            [
                'good' => Good::delete($id),
            ]
        );
    }

    public function addAction()
    {
        $goods_name = $_POST['goods_name'];
        $goods_price = $_POST['goods_price'];
        $goods_description = $_POST['goods_description'];


    }

    public function upAction()
    {}

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