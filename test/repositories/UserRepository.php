<?php

namespace App\repositories;

use App\entities\User;
use phpDocumentor\Reflection\Location;

class UserRepository extends Repository
{
    public function getTableName(): string
    {
        return 'users';
    }

    public function getEntityName(): string
    {
        return User::class;
    }

    /**
     * @param $login
     * @return User|null
     */
    public function getUserByLogin($login)
    {
        $sql = "SELECT * FROM users WHERE login = :login";
        return $this->getDB()->findObject(
            $sql,
            $this->getEntityName(),
            [':login' => $login]
        );
    }

    public function userAddDB($login, $name, $password, $address)
    {
        if (empty($login) || empty($name) || empty($password) || empty($address)) {
            header("Location /auth/userAddForm/");
            exit();
        }
        $sql = "INSERT INTO users (`login`, `name`, `password`, `address`) VALUES ('$login', '$name', '$password', '$address')";
        $this->getDB()->addObject($sql);
    }
}