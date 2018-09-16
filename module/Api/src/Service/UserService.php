<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 16/09/18
 * Time: 11:07
 */

namespace Api\Service;


use Api\Repository\UserRepository;

class UserService
{
    private $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function getUserRepository(): UserRepository
    {
        return $this->repository;
    }

    public function createNewUser()
    {

    }
}