<?php

namespace App\services;

use App\entities\Good;
use App\repositories\GoodRepository;

class GoodService
{
    public function save($id)
    {
        $good = new Good();

        if (!empty($id)) {
            $good = (new GoodRepository())->getOne($id);
        }

        $good->name = $_POST['name'];
        $good->info = $_POST['description'];
        $good->price = $_POST['price'];
        (new GoodRepository())->save($good);
    }
}