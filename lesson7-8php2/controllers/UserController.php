<?php

namespace App\controllers;

use App\entities\User;
use App\services\PaginatorServices;

class UserController extends Controller
{
    public function allAction()
    {
        $paginator = $this->app->paginatorServices;
        $paginator->setItems($this->app->userRepository, '/user/all', $this->getPage());
        return $this->render(
            'users',
            [
                'paginator' => $paginator,
            ]
        );
    }

    public function oneAction()
    {
        $id = $this->getId();
        return $this->render(
            'user',
            [
                'user' => $this->app->userRepository->getOne($id),
            ]
        );
    }

    public function delAction()
    {
        $id = $this->getId();
        $user = $this->app->userRepository->getOne($id);
        header("Location: /user/all");
        return $this->render(
            'user',
            [
                'user' => $this->app->userRepository->delete(),
            ]
        );
    }
}