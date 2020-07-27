<?php

namespace App\services;

use App\entities\Entity;
use App\repositories\UserRepository;

class PaginatorServices
{
    protected $items = [];
    protected $count = 0;
    protected $baseRot = '/?c=user&a=all';

    public function setItems(Entity $model, $pageNumber = 1)
    {
        $countData = (new UserRepository())->getCountList();
        $this->count = $countData['count'];
        $this->items = (new UserRepository())->getModelsByPage($pageNumber);
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getUrls()
    {
        $counter = intdiv($this->count, 10);
        if ($this->count % 10) {
            $counter++;
        }

        $urls = [];

        for ($i = 1; $i <= $counter; $i++) {
            $urls[$i] = $this->baseRot . '&page=' . $i;
        }

        return $urls;
    }
}