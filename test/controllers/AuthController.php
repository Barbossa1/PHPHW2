<?php

namespace App\controllers;

class AuthController extends Controller
{
    public function loginFormAction()
    {
        if ($this->app->authService->isGuest()) {
            return $this->render('loginForm');
        }

        $user = $this->app->authService->getUser();
        return $this->render('helloForm', ['name' => $user->getName()]);
    }

    public function userAddFormAction()
    {
        if ($this->app->authService->isGuest()) {
            return $this->render('userAddForm');
        }

        $user = $this->app->authService->getUser();
        return $this->render('helloForm', ['name' => $user->getName()]);
    }

    public function loginAction()
    {
        $result = $this->app->authService->login(
            $this->request->post('login'),
            $this->request->post('password')
        );

        $this->toPath('/auth/loginForm');
    }

    public function userAddAction()
    {
        $result = $this->app->authService->userAdd(
            $this->request->post('login'),
            $this->request->post('name'),
            $this->request->post('password'),
            $this->request->post('address')
        );

        $this->toPath('/auth/userAddForm');
    }

    public function logoutAction()
    {
        $this->app->authService->logout();
        $this->toPath('/auth/loginForm');
    }
}