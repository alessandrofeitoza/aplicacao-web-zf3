<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 19/09/18
 * Time: 13:39
 */

namespace Application\Service\Factory;


use Api\Service\UserService;
use Application\Service\AuthenticationService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthenticationServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AuthenticationService|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AuthenticationService(
            $container->get(UserService::class)
        );
    }
}