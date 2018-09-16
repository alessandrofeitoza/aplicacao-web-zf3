<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */


use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => PDOMySqlDriver::class,
                'params' => [
                    'host'     => '127.0.0.1',
                    'user'     => 'alessandro',
                    'password' => 'livre',
                    'dbname'   => 'db_webapp',
                ]
            ],
        ],

        'driver' => [
            'app_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../../module/Api/src/Entity',
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Api\Entity' => 'app_driver'
                ]
            ]
        ]
    ],
];