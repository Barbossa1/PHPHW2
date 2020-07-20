<?php

namespace App\controllers;

use App\models\Good;
use App\models\User;

class GoodController
{
    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $good = new Good();
            $id = $this->getId();
            if (!empty($id)) {
                $good = Good::getOne($id);
            }

            $good->name = $_POST['goods_name'];
            $good->info = $_POST['goods_price'];
            $good->price = $_POST['goods_description'];
            $good->save();
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
            ['good' => Good::getOne($this->getId()) ]
        );
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
}