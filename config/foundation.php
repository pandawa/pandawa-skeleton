<?php

use Pandawa\Component\Foundation\Console\Kernel as ConsoleKernel;
use Pandawa\Component\Foundation\Http\Kernel as HttpKernel;

return [
    'app_path' => __DIR__ . '/../src',

    'bootstrap_providers' => [
        \Illuminate\Events\EventServiceProvider::class,
        \Illuminate\Log\LogServiceProvider::class,
        \Illuminate\Routing\RoutingServiceProvider::class,
        \Pandawa\Component\Foundation\ServiceProvider\ConfigServiceProvider::class,
    ],

    'console' => [
        'kernel' => [
            'class' => ConsoleKernel::class,
            'bootstrappers' => [
                \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
                \Pandawa\Component\Foundation\Bootstrap\LoadConfiguration::class,
                \Illuminate\Foundation\Bootstrap\HandleExceptions::class,
                \Illuminate\Foundation\Bootstrap\RegisterFacades::class,
                \Illuminate\Foundation\Bootstrap\SetRequestForConsole::class,
                \Illuminate\Foundation\Bootstrap\RegisterProviders::class,
                \Pandawa\Component\Foundation\Bootstrap\ConfigureBundles::class,
                \Illuminate\Foundation\Bootstrap\BootProviders::class,
            ],
        ],
    ],

    'http' => [
        'kernel'     => [
            'class'         => HttpKernel::class,
            'bootstrappers' => [
                \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
                \Pandawa\Component\Foundation\Bootstrap\LoadConfiguration::class,
                \Illuminate\Foundation\Bootstrap\HandleExceptions::class,
                \Illuminate\Foundation\Bootstrap\RegisterFacades::class,
                \Illuminate\Foundation\Bootstrap\RegisterProviders::class,
                \Pandawa\Component\Foundation\Bootstrap\ConfigureBundles::class,
                \Illuminate\Foundation\Bootstrap\BootProviders::class,
            ],
        ],
        'middleware' => [
            'all'    => [
                Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
                Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
                Illuminate\Foundation\Http\Middleware\TrimStrings::class,
                Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
                Illuminate\Http\Middleware\TrustProxies::class,
            ],
            'groups' => [],
            'routes' => [],
        ],
    ],

    'exception' => [
        'handler' => Pandawa\Component\Foundation\Handler\ExceptionHandler::class,
    ],
];
