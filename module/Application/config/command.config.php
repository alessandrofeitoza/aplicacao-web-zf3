<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 19/09/18
 * Time: 14:56
 */

namespace Application;

use Application\Command\ApplicationCommand;
use Zend\Mvc\Console\Router\Simple;

return [
    'router' => [
        'routes' => [
            'create-console-user' => [
                'type' => Simple::class,
                'options' => [
                    'route' => 'user add <email> <password>',
                    'defaults' => [
                        'controller' => ApplicationCommand::class,
                        'action' => 'addUser',
                    ],
                ],
            ],
        ],
    ],
];