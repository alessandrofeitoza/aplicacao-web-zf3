<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Api;

use Api\Controller\UserRestController;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'user-rest' => [
                'type'      => Segment::class,
                'options'   => [
                    'route'     => '/api/user[/:id][/]',
                    'defaults'  => [
                        'controller' => UserRestController::class,
                    ],
                ],
            ],
            'user-rest-find-expression' => [
                'type'      => Segment::class,
                'options'   => [
                    'route'     => '/api/user/like/:expression[/]',
                    'defaults'  => [
                        'controller' => UserRestController::class,
                        'action'     => 'findByLike',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'layout/api' => __DIR__ . '/../view/layout/api.phtml',
        ],

        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
