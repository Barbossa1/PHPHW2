<?php

namespace App\services;

use App\models\Model;

class PaginatorServices
{
    protected $items = [];
    protected $count = 0;
    protected $baseRot = '/?c=user&a=all';

    public function setItems(Model $model, $pageNumber = 1)
    {
        $countData = $model->getCountList();
        $this->count = $countData['count'];
        $this->items = $model->getModelsByPage($pageNumber);
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