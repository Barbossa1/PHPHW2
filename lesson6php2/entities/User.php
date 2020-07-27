<?php

namespace App\entities;

class User extends Entity
{
    private $id;
    private $user_login;
    private $user_password;
    private $user_address;

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
    public function getLogin()
    {
        return $this->user_login;
    }

    /**
     * @param mixed $user_login
     */
    public function setLogin($user_login): void
    {
        $this->user_login = $user_login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->user_password;
    }

    /**
     * @param mixed $user_password
     */
    public function setPassword($user_password): void
    {
        $this->user_password = $user_password;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->user_address;
    }

    /**
     * @param mixed $user_address
     */
    public function setAddress($user_address): void
    {
        $this->user_address = $user_address;
    }
}