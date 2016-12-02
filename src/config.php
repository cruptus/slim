<?php

$config = [
    /**
     * Choix de l'environnement :
     * development / test / production
     */
    'environment' => 'development',

    /**
     * Différent connecteurs pour selon l'environnement
     */
    'db' => [
        'production' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'production_database',
            'username' => 'production_user',
            'password' => 'production_password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
        'test' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'test_database',
            'username' => 'test_user',
            'password' => 'test_password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
        'development' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'node',
            'username' => 'root',
            'password' => 'toor',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],

    /**
     * Configuration de la session
     * name : Nom de la session cookie
     * lifetime : default '1 hour'
     * autorefresh : Refresh la session automatiquement quand l'utilisateur est actif
     */
    'session' => [
        'name' => 'slim_session',
        'autorefresh' => true,
        'lifetime' => '1 hour'
    ]
];

/**
 * Ne pas toucher
 */
$settings = [
    'settings' => [
        'displayErrorDetails' => ($config['environment'] != 'production')? true : false,
        'db' => $config['db'][$config['environment']],
        'session_settings' => $config['session']
    ]
];