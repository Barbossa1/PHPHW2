<?php

namespace App\services;

use App\controllers\BasketController;
use App\repositories\GoodRepository;

class BasketServices extends Service
{
    const GOODS = 'goods';

    public function add(GoodRepository $goodRepository, Request $request,$id)
    {
        if (empty($id)) {
            return false;
        }

        $good = $goodRepository->getOne($id);

        if (empty($good)) {
            return false;
        }
        $goods = $request->getSession(static::GOODS, array());

        if (empty($goods[$id])) {
            $goods[$id] = [
                'name' =>  $good->name,
                'price' =>  $good->price,
                'count' =>  1,
            ];
        } else {
            $goods[$id]['count'] ++;
        }

        $request->setSession(static::GOODS, $goods);

        return true;
    }
}