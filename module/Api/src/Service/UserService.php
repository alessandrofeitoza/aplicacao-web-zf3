<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 16/09/18
 * Time: 11:07
 */

namespace Api\Service;


use Api\Entity\User;
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

    public function createNewUser(array $data): User
    {
        if ($this->getUserRepository()->findOneBy(['email' => $data['email']])) {
            throw new \Exception('Email já existe');
        }

        $user = new User();
        $user
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setRole(User::ROLE_DEFAULT)
            ->setPassword(password_hash($data['password'], PASSWORD_ARGON2I));

        $user = $this->getUserRepository()->save($user);

        return $user;
    }

    public function updateById($id, array $data): User
    {
        /**
         * @var User $user
         */
        $user = $this->getUserRepository()->findOneBy(['id' => $id]);

        if (!$user) {
            throw new \Exception('Usuário não encontrado');
        }

        if ($data['password'] && $data['password'] != '') {
            $data['password'] = password_hash($data['password'], PASSWORD_ARGON2I);
        }

        $user
            ->setName($data['name'] ?? $user->getName())
            ->setEmail($data['email'] ?? $user->getEmail())
            ->setPassword($data['password'] ?? $user->getPassword());

        $user = $this->getUserRepository()->save($user);

        return $user;
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function deleteOneById($id): void
    {
        /**
         * @var User $user
         */
        $user = $this->getUserRepository()->findOneBy(['id' => $id]);

        if (!$user) {
            throw new \Exception('Usuário não encontrado');
        }

        $this->getUserRepository()->deleteOne($user);
    }
}