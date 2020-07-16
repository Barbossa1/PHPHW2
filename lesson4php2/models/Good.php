<?php
namespace App\models;

class Good extends Model
{
    public $id;
    public $goods_name;
    public $goods_price;
    public $goods_description;
    public $goods_img;

    public static function getTableName(): string
    {
        return 'goods';
    }
}