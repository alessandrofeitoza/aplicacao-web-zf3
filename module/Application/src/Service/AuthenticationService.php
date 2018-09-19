<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 19/09/18
 * Time: 13:36
 */

namespace Application\Service;


use Api\Entity\User;
use Api\Service\UserService;
use Zend\Session\Container;

class AuthenticationService
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function authenticate(string $email, string $password): User
    {
        /**
         * @var User $user
         */
        $user = $this->userService->getUserRepository()->findOneBy(['email' => $email]);

        if (!$user) {
            throw new \Exception('Usuário não encontrado');
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new \Exception('Senha incorreta');
        }

        $this->createSession($user);

        return $user;
    }

    private function createSession(User $user)
    {
        $container = new Container('user');
        $container->user = $user;

        return true;
    }
}