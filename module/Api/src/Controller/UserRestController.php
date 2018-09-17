<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 16/09/18
 * Time: 11:05
 */

namespace Api\Controller;


use Api\Entity\User;
use Api\Service\UserService;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Serializer\Adapter\AdapterInterface as ZendSerializer;
use Zend\View\Model\JsonModel;

class UserRestController extends AbstractRestfulController
{
    private $userService;
    private $serializer;

    public function __construct(UserService $userService, ZendSerializer $serializer)
    {
        $this->userService = $userService;
        $this->serializer = $serializer;
    }

    public function create($data)
    {
        try {
            $user = $this->userService->createNewUser($data);
        } catch (\Exception $exception) {
            $this->getResponse()->setStatusCode(500);
            return new JsonModel([
                'message'   => 'Erro ao cadastrar usuário',
                'error'     => $exception->getMessage(),
            ]);
        }

        return new JsonModel([
            'message'   => 'Novo usuário criado',
            'data'      => $user->extract(),
        ]);
    }

    public function get($id)
    {
        try {
            $user = $this->userService->getUserRepository()->findOneBy(['id' => $id]);
        } catch (\Exception $exception) {
            $this->getResponse()->setStatusCode(500);
            return new JsonModel([
                'message'   => 'Erro ao buscar usuário',
                'error'     => $exception->getMessage()
            ]);
        }

        if (!$user) {
            $this->getResponse()->setStatusCode(400);
            return new JsonModel([
                'message'   => 'Erro ao buscar usuário',
                'error'     => 'Usuário não encontrado',
            ]);
        }

        return new JsonModel([
            'message'   => 'Usuário encontrado',
            'data'      => $user->extract(),
        ]);
    }

    public function getList()
    {
        try {
            $users = $this->userService->getUserRepository()->findAll();
        } catch (\Exception $exception) {
            $this->getResponse()->setStatusCode(500);
            return new JsonModel([
                'message'   => 'Erro ao buscar usuários',
                'error'     => $exception->getMessage()
            ]);
        }

        $users = array_map( function (User $user) {
            return $user->extract();
        }, $users);

        return new JsonModel([
            'message'   => 'Usuários Encontrados',
            'data'      => $users,
        ]);
    }

    public function update($id, $data)
    {
        try {
            $user = $this->userService->updateById($id, $data);
        } catch (\Exception $exception) {
            $this->getResponse()->setStatusCode(500);
            return new JsonModel([
                'message'   => 'Erro ao editar usuário',
                'error'     => $exception->getMessage()
            ]);
        }

        return new JsonModel([
            'message'   => 'Usuário Atualizado',
            'data'      => $user->extract(),
        ]);
    }

    public function delete($id)
    {
        try {
            $this->userService->deleteOneById($id);
        } catch (\Exception $exception) {
            $this->getResponse()->setStatusCode(500);
            return new JsonModel([
                'message'   => 'Erro ao excluir usuário',
                'error'     => $exception->getMessage()
            ]);
        }

        return new JsonModel([
            'message'   => 'Usuário Excluído',
        ]);
    }
}