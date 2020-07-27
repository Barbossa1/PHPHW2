<?php

namespace App\controllers;

use App\models\Good;
use App\models\User;

class GoodController  extends Controller
{
    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $this->getId();
            (new GoodService())->save($id);
            header('Location: ?c=good&a=all');
            return;
        }

        return $this->render(
            'addGood',
            ['good' => new Good() ]
        );
    }

    public function updateAction()
    {
        return $this->render(
            'addGood',
            ['good' => (new GoodRepository())->getOne($this->getId()) ]
        );
    }

    public function allAction()
    {
        return $this->render(
            'goods',
            [
                'goods' => (new GoodRepository())->getAll(),
            ]
        );
    }

    public function oneAction()
    {
        $id = $this->getId();
        return $this->render(
            'good',
            [
                'good' => (new GoodRepository())->getOne($id),
            ]
        );
    }
}