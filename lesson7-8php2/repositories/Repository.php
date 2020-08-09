<?php

namespace App\repositories;

use App\engine\App;
use App\engine\Container;
use App\entities\Entity;
use App\services\DB;

abstract class Repository
{
    protected $db;

    /**
     * @var Container
     */
    protected $container;

    /**
     * Возвращает название таблицы
     *
     * @return string
     */
    abstract public function getTableName(): string;
    abstract public function getEntityName(): string;

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return DB
     */
    protected function getDB()
    {
        return $this->container->db;
        return App::call()->db;
    }

    public function getModelsByPage($page = 1)
    {
        $start = ($page - 1) * 10;
        $sql = "SELECT * FROM " . $this->getTableName() . " LIMIT {$start}, 10";
        return $this->getDB()->findObjects($sql, $this->getEntityName());
    }

    public function getCountList()
    {
        $sql = "SELECT count(*) AS `count` FROM " . $this->getTableName();
        return $this->getDB()->find($sql);
    }

    public function getOne($id)
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE id = :id';
        return $this->getDB()->findObject($sql, $this->getEntityName(), [':id' => $id]);
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() ;
        return $this->getDB()->findObjects($sql, $this->getEntityName());
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . $this->getTableName() . ' WHERE id = :id';
        return $this->getDB()->execute($sql, [':id' => $this->id]);
    }

    public function insert(Entity $entity)
    {
        $columns = [];
        $params = [];

        foreach ($entity as $key => $value) {
            if ($key == 'id' || empty($value)) {
                continue;
            }

            $columns[] = $key;
            $params[':' . $key] = $value;
        }

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->getTableName(),
            implode(',', $columns),
            implode(',', array_keys($params))
        );

        $this->getDB()->execute($sql, $params);
        $entity->id = $this->getDB()->getInsertId();
    }

    protected function update()
    {

    }

    public function save(Entity $entity)
    {
        if(empty($entity->id)) {
            $this->insert($entity);
            return;
        }
        $this->update($entity);
        return;
    }
}