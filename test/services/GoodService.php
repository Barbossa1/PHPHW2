<?php

namespace App\services;

use App\entities\Good;
use App\repositories\GoodRepository;

class GoodService extends Service
{
    public function save($id, $data)
    {
        if (!$this->isVerifiedData($data)) {
            return null;
        }

        $good = new Good();

        if (!empty($id)) {
            $good = $this->container->goodRepository->getOne($id);
        }

        $good->name = $data['name'];
        $good->info = $data['info'];
        $good->price = $data['price'];
        $good->picture = $data['picture'];
        $this->container->goodRepository->save($good);

        return $good;
    }

    protected function isVerifiedData($data)
    {
        if (empty($data['name']) || empty($data['info']) || empty($data['price']) || empty($data['picture'])) {
            return false;
        }
        return true;
    }
}