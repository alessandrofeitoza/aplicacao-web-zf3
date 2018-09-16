<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Repository\Factory\UserRepositoryFactory;
use Application\Repository\UserRepository;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements ConfigProviderInterface, ControllerProviderInterface, ServiceProviderInterface
{
    const VERSION = '3.0.3-dev';

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
                UserRepository::class => UserRepositoryFactory::class,
            ],
        ];
    }


}
