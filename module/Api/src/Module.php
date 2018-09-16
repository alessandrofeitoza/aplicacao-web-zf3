<?php

namespace Api;

use Api\Controller\Factory\UserRestControllerFactory;
use Api\Controller\IndexController;
use Api\Controller\UserRestController;
use Api\Repository\Factory\UserRepositoryFactory;
use Api\Repository\UserRepository;
use Api\Service\Factory\UserServiceFactory;
use Api\Service\UserService;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ServiceManager\Factory\InvokableFactory;

class Module implements ConfigProviderInterface, ControllerProviderInterface, ServiceProviderInterface
{
    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerConfig(): array
    {
        return [
            'factories' => [
                UserRestController::class   => UserRestControllerFactory::class,
            ],
        ];
    }

    /**
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                UserRepository::class   => UserRepositoryFactory::class,
                UserService::class      => UserServiceFactory::class,
            ],
        ];
    }


}
