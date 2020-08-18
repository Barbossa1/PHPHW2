<?php

namespace App\services;

use App\entities\User;

class AuthService extends Service
{
    public function login($login, $password)
    {
        $user = $this->container->userRepository->getUserByLogin($login);
        if (empty($user)) {
            return false;
        }

        $resultLogin = $this->isRealPassword($user->getPassword(), $password);

        if ($resultLogin) {
            $this->container->request->setSession('auth', $user);
        }

        return $resultLogin;
    }

    public function userAdd($login, $name, $password, $address)
    {
        $userAdd = $this->container->userRepository->userAddDB($login, $name, $password, $address);
        if (empty($userAdd)) {
            return false;
        }
    }

    public function logout()
    {
        $this->container->request->setSession('auth', null);
    }

    public function isGuest()
    {
        return empty($this->container->request->getSession('auth'));
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        return $this->container->request->getSession('auth');
    }

    /**
     * @param $passwordFromForm
     * @param $passwordFromDB
     * @return bool
     */
    public function isRealPassword($passwordFromForm, $passwordFromDB)
    {
        return $passwordFromForm == $passwordFromDB;
    }
}