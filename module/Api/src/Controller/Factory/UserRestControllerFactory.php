<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 16/09/18
 * Time: 11:06
 */

namespace Api\Controller\Factory;


use Api\Controller\UserRestController;
use Api\Service\UserService;
use Interop\Container\ContainerInterface;
use Zend\Serializer\Adapter\PhpSerialize;
use Zend\Serializer\Serializer;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserRestControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): UserRestController
    {
        $serializer = Serializer::factory(PhpSerialize::class);

        return new UserRestController(
            $container->get(UserService::class),
            $serializer
        );
    }
}