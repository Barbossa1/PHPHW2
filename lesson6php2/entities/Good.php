<?php

namespace App\entities;

class Good extends Entity
{
    private $id;
    private $goods_name;
    private $goods_price;
    private $goods_description;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->goods_name;
    }

    /**
     * @param mixed $goods_name
     */
    public function setName($goods_name): void
    {
        $this->goods_name = $goods_name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->goods_price;
    }

    /**
     * @param mixed $goods_price
     */
    public function setPrice($goods_price): void
    {
        $this->goods_price = $goods_price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->goods_description;
    }

    /**
     * @param mixed $goods_description
     */
    public function setDescription($goods_description): void
    {
        $this->goods_description = $goods_description;
    }
}