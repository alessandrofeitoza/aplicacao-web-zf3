<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 19/09/18
 * Time: 12:37
 */

namespace Application\Controller;


use Api\Service\UserService;
use Application\Service\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\AbstractController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class AuthenticationController extends AbstractActionController
{
    private $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function loginAction()
    {
        return new ViewModel();
    }

    public function authAction()
    {
        $request = (array) $this->getRequest()->getPost();

        if (!$request['email'] OR !$request['password']) {
            $this->getResponse()->setStatusCode(400);
            return new JsonModel([
                'message'   => 'Erro ao autenticar',
                'error'     => 'email e password são obrigatórios',
            ]);
        }

        try {
            $user = $this->authenticationService->authenticate($request['email'], $request['password']);
        } catch (\Exception $exception) {
            $this->getResponse()->setStatusCode(400);
            return new JsonModel([
                'message'   => 'Erro ao autenticar',
                'error'     => $exception->getMessage(),
            ]);
        }

        return new JsonModel([
            'message' => 'Usuário logado com sucesso',
            'data' => $user->extract(),
        ]);
    }
}