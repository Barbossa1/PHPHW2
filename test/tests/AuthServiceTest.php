<?php
//
//namespace App\tests;
//
//use App\entities\User;
//use App\repositories\UserRepository;
//use App\services\AuthService;
//use PHPUnit\Framework\TestCase;
//use PHPUnit\Framework\MockObject\MockObject;
//
//class AuthServiceTest extends TestCase
//{
//
//    public function testLoginEmptyUser()
//    {
//        /** @var MockObject/User $loginMock */
//        $loginMock = $this->getMockBuilder(User::class)->getMock();
//
//        /** @var MockObject/User $passwordMock */
//        $passwordMock = $this->getMockBuilder(User::class)->getMock();
//
//        $userMock = $this->getMockBuilder(UserRepository::class)->getMock();
//        $userMock
//            ->expects($this->never())
//            ->method('getUserByLogin');
//
//        $services = new AuthService();
//        $result = $services->login($loginMock, $passwordMock);
//        $this->assertFalse($result);
//    }
//}
