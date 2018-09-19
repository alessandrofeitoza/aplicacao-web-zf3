<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Command\ApplicationCommand;
use Application\Command\Factory\ApplicationCommandFactory;
use Application\Controller\AuthenticationController;
use Application\Controller\Factory\AuthenticationControllerFactory;
use Application\Controller\IndexController;
use Application\Service\AuthenticationService;
use Application\Service\Factory\AuthenticationServiceFactory;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Session\Container;

class Module implements ConfigProviderInterface, ControllerProviderInterface, ServiceProviderInterface
{
    const VERSION = '3.0.3-dev';

    public function onBootstrap(MvcEvent $event)
    {
        $application = $event->getApplication();
        $serviceManager = $application->getServiceManager();

        $routes = include __DIR__ . '/../config/routes.config.php';

        $application->getEventManager()->attach(MvcEvent::EVENT_DISPATCH,
            function (MvcEvent $event) use ($serviceManager, $application, $routes) {

                $routeName = $event->getRouteMatch()->getMatchedRouteName();

                $session = new Container('user');

                if (!$session->offsetGet('user') AND !in_array($routeName, $routes['default'])) {
                    header('location: /login?msg=Permissão+Negada'); exit;
                }

                $event->getViewModel()->setVariable('user', $session->offsetGet('user'));

            }, 200
        );
    }


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
                IndexController::class          => InvokableFactory::class,
                AuthenticationController::class => AuthenticationControllerFactory::class,
                ApplicationCommand::class       => ApplicationCommandFactory::class,
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
                AuthenticationService::class    => AuthenticationServiceFactory::class,
            ],
        ];
    }

    public function on()
    {

    }


}
