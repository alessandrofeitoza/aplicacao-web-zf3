<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 19/09/18
 * Time: 14:55
 */

namespace Application\Command;


use Api\Entity\User;
use Api\Service\UserService;
use Zend\Mvc\Console\Controller\AbstractConsoleController;

class ApplicationCommand extends AbstractConsoleController
{
    private $userSevice;

    public function __construct(UserService $userService)
    {
        $this->userSevice = $userService;
    }

    public function addUserAction()
    {
        $user = [
            'name' => 'Usuário Padrão',
            'email' => $this->params('email'),
            'password' => $this->params('password'),
        ];

        try {
            $user = $this->userSevice->createNewUser($user);
        } catch (\Exception $exception) {
            $this->console->writeLine('--------------------------------------------------------------');
            $this->console->writeLine('-- ERRO: ' . $exception->getMessage() . ' - ');
            $this->console->writeLine('--------------------------------------------------------------');
            return true;
        }

        $this->console->writeLine('--------------------------------------------------------------');
        $this->console->writeLine('-- OK, Um novo usuário foi criado. - ');
        $this->console->writeLine('--------------------------------------------------------------');
        $this->console->writeLine('Nome: ' . $user->getName());
        $this->console->writeLine('Email: ' . $user->getEmail());
        $this->console->writeLine('id: ' . $user->getId());
        $this->console->writeLine('--------------------------------------------------------------');

        return true;
    }
}