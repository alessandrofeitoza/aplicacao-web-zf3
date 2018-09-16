<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 16/09/18
 * Time: 11:07
 */

namespace Api\Service\Factory;


use Api\Repository\UserRepository;
use Api\Service\UserService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): UserService
    {
        return new UserService(
            $container->get(UserRepository::class)
        );
    }
}