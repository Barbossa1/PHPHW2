<?php

namespace App\services;

use App\repositories\Repository;

class PaginatorServices extends Service
{
    protected $items = [];
    protected $count = 0;
    protected $baseRot = '';

    public function setItems(Repository $repository, $baseRot, $pageNumber = 1)
    {
        $this->baseRot = $baseRot;
        $countData = $repository->getCountList();
        $this->count = $countData['count'];
        $this->items = $repository->getModelsByPage($pageNumber);
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
            $urls[$i] = $this->baseRot . '?page=' . $i;
        }

        return $urls;
    }
}