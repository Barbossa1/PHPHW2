<?php

namespace App\tests;

use App\services\BasketServices;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use App\services\Request;
use App\repositories\GoodRepository;

class BasketServicesTest extends TestCase
{
    public function testAddEmptyId()
    {
        /** @var MockObject/GoodRepository $goodRepositoryMock */
        $goodRepositoryMock = $this->getMockBuilder(GoodRepository::class)
            ->getMock();
        $goodRepositoryMock
            ->expects($this->never())
            ->method('getOne');
        /** @var MockObject/Request $requestMock */
        $requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();
        $services = new BasketServices();
        $result = $services->add($goodRepositoryMock, $requestMock, 0);
        $this->assertFalse($result);
    }
}
