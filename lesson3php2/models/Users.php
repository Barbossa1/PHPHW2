<?php
namespace App\models;

class Users extends Model
{
    public $id;
    public $user_login;
    public $user_password;
    public $user_address;

    public function getTableName(): string
    {
        return 'users';
    }
}