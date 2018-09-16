<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 16/09/18
 * Time: 11:09
 */

namespace Api\Repository\Factory;


use Api\Repository\UserRepository;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return UserRepository
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): UserRepository
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new UserRepository(
            $entityManager
        );
    }

}