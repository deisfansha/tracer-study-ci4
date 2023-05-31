<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'filterusers'   => \App\Filters\FilterUsers::class,
        'filteradmin'   => \App\Filters\FilterAdmin::class
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'filteradmin' => [
                'except' => [
                    'Login', 'Login/*',
                    'Page', 'Page/*',
                    '/'
                ]
            ],
            'filterusers' => [
                'except' => [
                    'Login', 'Login/*',
                    'Page', 'Page/*',
                    '/'
                ]
            ]

            //'FilterAdmin' => [
            //    'except' => ['login/*', 'login', 'page', 'page/*']
            //],
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'filteradmin' => [
                'except' => [
                    '/',
                    'Login/*',
                    'Home', 'Home/*',
                    'Hasil', 'Hasil/*',
                    'Konten', 'Konten/*',
                    'Kuesioner', 'Kuesioner/*',
                    'Question', 'Question/*',
                    'Fakultas', 'Fakultas/*',
                    'Users', 'Users/*',
                    'Password', 'password/*'
                ]
            ],
            'filterusers' => [
                'except' => [
                    '/',
                    'HomeUsers', 'HomeUsers/*',
                    'Profil', 'Profil/*',
                    'KuesionerUsers', 'KuesionerUsers/*',
                    'Password', 'password/*',
                    'hasilUsers', 'hasilUsers/*'
                ]
            ],
            //'FilterAdmin' => [
            //    'except' => ['home/*', 'kuesioner/*', 'hasil/*', 'question/*', 'users/*']
            //],
            //'filterUser' => ['except' => ['']],
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    // public $filters = [
    //     'isLoggedIn' => ['before' => [
    //         'home',
    //         'users',
    //         'users/*',
    //         'profil',
    //         'profil/*',
    //         'question',
    //         'question/*'
    //     ]]
    // ];
}
