<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 16/09/18
 * Time: 11:05
 */

namespace Api\Controller;


use Api\Service\UserService;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class UserRestController extends AbstractRestfulController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function get($id)
    {
        return new JsonResponse([

        ], 200);
    }

    public function getList()
    {
        try {
            $users = $this->userService->getUserRepository()->findAll();
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage(), 500);
        }

        return new JsonModel([
            'data' => $users,
        ]);
    }
}