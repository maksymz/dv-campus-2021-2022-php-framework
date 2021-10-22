<?php

declare(strict_types=1);

use DVCampus\Framework\Database\Adapter\MySQL;

return [
    \DVCampus\Framework\Database\Adapter\AdapterInterface::class => DI\get(
        MySQL::class
    ),
    MySQL::class => DI\autowire()->constructorParameter(
        'connectionParams',
        [
            MySQL::DB_NAME     => 'dv_campus_blog',
            MySQL::DB_USER     => 'dv_campus_blog_user',
            MySQL::DB_PASSWORD => '45Ya!$""sT&P*C%RNSEhr',
            MySQL::DB_HOST     => 'mysql',
            MySQL::DB_PORT     => '3306'
        ]
    ),
    \DVCampus\Framework\Http\RequestDispatcher::class => DI\autowire()->constructorParameter(
        'routers',
        [
            \DI\get(\DVCampus\Cms\Router::class),
            \DI\get(\DVCampus\Catalog\Router::class),
            \DI\get(\DVCampus\ContactUs\Router::class),
            \DI\get(\DVCampus\Install\Router::class),
        ]
    )
];
