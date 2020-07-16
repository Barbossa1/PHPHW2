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

    public static function getOne($id)
    {
        $sql = 'SELECT * FROM ' . static::getTableName() . ' WHERE id = :id';
        return static::getDB()->findObject($sql, static::class, [':id' => $id]);
    }

    public static function getAll()
    {
        $sql = 'SELECT * FROM ' . static::getTableName();
        return static::getDB()->findObjects($sql, static::class);
    }

    public static function delete($id)
    {
        $sql = 'DELETE FROM ' . static::getTableName() . ' WHERE id = :id';
        return static::getDB()->deleteObject($sql, static::class, [':id' => $id]);
    }

    public static function insert()
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

    public static function update($id)
    {
        $columns = [];
        $params = [];

        foreach ($this as $key => $value) {
            if ($key == 'id' || $key == 'goods_img' || empty($value)) {
                continue;
            }

            $columns[] = $key;
            $params[':' . $key] = $value;
        }

        $sql = sprintf(
            "UPDATE %s SET (%s)=(%s)",
            static::getTableName(),
            implode(',', $columns),
            implode(',', array_keys($params))
        );

        static::getDB()->execute($sql, $params);
    }

//    public function save()
//    {
//        if(empty($this->id)) {
//            return static::insert();
//        }
//        return static::update();
//    }
}