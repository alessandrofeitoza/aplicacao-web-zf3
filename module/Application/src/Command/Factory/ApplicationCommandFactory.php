<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 19/09/18
 * Time: 15:09
 */

namespace Application\Command\Factory;


use Api\Service\UserService;
use Application\Command\ApplicationCommand;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ApplicationCommandFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ApplicationCommand|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ApplicationCommand(
            $container->get(UserService::class)
        );
    }
}