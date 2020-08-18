<?php

namespace App\controllers;

use App\entities\Good;
use App\entities\User;
use App\repositories\GoodRepository;
use App\services\GoodService;

class GoodController extends Controller
{
    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $this->getId();
            $this->app->goodService->save(
                $id,
                $this->request->post()
            );
            header('Location: ?c=good&a=all');
            return;
        }

        return $this->render(
            'addGood',
            ['good' => new Good() ]
        );
    }

    public function updateAction()
    {
        return $this->render(
            'addGood',
            ['good' => $this->app->goodRepository->getOne($this->getId()) ]
        );
    }

    public function allAction()
    {
        $paginator = $this->app->paginatorServices;
        $paginator->setItems($this->app->goodRepository, '/good/all', $this->getPage());
        return $this->render(
            'goods',
            [
                'paginator' => $paginator,
            ]
        );
    }

    public function oneAction()
    {
        $id = $this->getId();
        return $this->render(
            'good',
            [
                'good' => $this->app->goodRepository->getOne($id),
            ]
        );
    }
}