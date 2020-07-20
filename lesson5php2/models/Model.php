<?php
namespace App\models;

use App\services\DB;

abstract class Model
{
    /**
     * Возвращает название таблицы
     *
     * @return string
     */
    abstract public static function getTableName(): string;

    /**
     * @return DB
     */
    protected static function getDB()
    {
        return DB::getInstance();
    }

    public function getModelsByPage($page = 1)
    {
        $start = ($page - 1) * 10;
        $sql = "SELECT * FROM " . static::getTableName() . " LIMIT {$start}, 10";
        return static::getDB()->findObjects($sql, static::class);
    }

    public function getCountList()
    {
        $sql = "SELECT count(*) AS `count` FROM " . static::getTableName();
        return static::getDB()->find($sql);
    }

    public static function getOne($id)
    {
        $sql = 'SELECT * FROM ' . static::getTableName() . ' WHERE id = :id';
        return static::getDB()->findObject($sql, static::class, [':id' => $id]);
    }

    public static function getAll()
    {
        $sql = 'SELECT * FROM ' . static::getTableName() ;
        return static::getDB()->findObjects($sql, static::class);
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::getTableName() . ' WHERE id = :id';
        return static::getDB()->execute($sql, [':id' => $this->id]);
    }

    public function insert()
    {
        $columns = [];
        $params = [];

        foreach ($this as $key => $value) {
            if ($key == 'id' || empty($value)) {
                continue;
            }

            $columns[] = $key;
            $params[':' . $key] = $value;
        }

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            static::getTableName(),
            implode(',', $columns),
            implode(',', array_keys($params))
        );

        static::getDB()->execute($sql, $params);
        $this->id = static::getDB()->getInsertId();
    }

    protected function update()
    {

    }

    public function save()
    {
        if(empty($this->id)) {
            $this->insert();
            return;
        }
        $this->update();
        return;
    }
}