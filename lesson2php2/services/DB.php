<?php

class DB implements IDB
{
    public function find($sql)
    {
        return $sql;
    }
}