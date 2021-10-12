<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
    public $aliases = [
        'csrf'     => CSRF::class,
        'toolbar'  => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'authFilter' => \App\Filters\AuthFilter::class,
        'adminFilter' => \App\Filters\AdminFilter::class,
    ];

    public $globals = [
        'before' => [
            'authFilter' => ['except' => 'auth/*']
        ],
        'after' => [
            'toolbar',
        ],
    ];

    public $methods = [];

    public $filters = [
        'adminFilter' => [
            'before' => [
                'barang/*',
            ]
        ],
    ];
}
