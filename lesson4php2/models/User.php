<?php
namespace App\models;

class User extends Model
{
    public $id;
    public $user_login;
    public $user_password;
    public $user_address;

    public static function getTableName(): string
    {
        return 'users';
    }
}