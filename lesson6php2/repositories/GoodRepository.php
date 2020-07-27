<?php

namespace App\repositories;

use App\entities\Good;

class GoodRepository extends Repository
{
    public function getTableName(): string
    {
        return 'goods';
    }

    public function getEntityName(): string
    {
        return Good::class;
    }
}