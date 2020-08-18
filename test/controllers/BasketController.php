<?php

namespace App\controllers;

use App\repositories\GoodRepository;
use App\services\BasketServices;
use App\services\PaginatorServices;

class BasketController extends Controller
{
    protected $actionDefault = 'index';

    public function indexAction()
    {
        $object = $this->request->getSession(BasketServices::GOODS);
        return $this->render(
            'basket',
            [
                'paginator' => $object,
            ]);
    }

    public function addAction()
    {
        $isAdd = (new BasketServices())->add((new GoodRepository()), $this->request, $this->getId());

        $msg = 'Товар добавлен';
        if (!$isAdd) {
            $msg = 'Ошибка при добавлении';
        }

        $this->toPath('', $msg);
    }

    public function addAjaxAction()
    {
        $isAdd = (new BasketServices())->add(
            (new GoodRepository()),
            $this->request,
            $this->getId()
        );

        $msg = 'Товар добавлен в корзину';

        if (!$isAdd) {
            $msg = 'Ошибка добавления товара в корзину';
        }

        return $this->request->getResponse([
            'msg' => $msg,
            'success' => $isAdd
        ]);
    }
}