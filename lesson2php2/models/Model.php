<?php
namespace App\models;

abstract class Model
{
    protected $db;

    abstract public function getTableName(): string;

    public function __construct(IDB $db)
    {
        $this->db = $db;
    }

    public function getOne($id)
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = ' . $id;
        return $this->db->find($sql);
    }
}