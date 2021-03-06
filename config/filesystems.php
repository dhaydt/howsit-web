<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'cloud' => 'google', // Optional: set Google Drive as default cloud storage

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => public_path('/'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => public_path('app/public'),
            'url' => env('APP_URL').'/public',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],

        'public_uploads' => [
            'driver' => 'local',
            // 'root'   => '/storage',
            'root' => public_path().'/public',
            'visibility' => 'public',
        ],

        'google' => [
            'driver' => 'google',
            'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
            'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
            'folderId' => env('GOOGLE_DRIVE_FOLDER_ID'),
            'redirect' => 'http://127.0.0.1:8000/callback/google',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

    // 000webhost
    // 'disks' => [

    //     'local' => [
    //         'driver' => 'local',
    //         'root' => public_path('../public_html'),
    //     ],

    //     'public' => [
    //         'driver' => 'local',
    //         'root' => storage_path('/ssd3/638/14213638'),
    //         'url' => env('APP_URL').'/storage',
    //         'visibility' => 'public_html',
    //     ],

    //     's3' => [
    //         'driver' => 's3',
    //         'key' => env('AWS_ACCESS_KEY_ID'),
    //         'secret' => env('AWS_SECRET_ACCESS_KEY'),
    //         'region' => env('AWS_DEFAULT_REGION'),
    //         'bucket' => env('AWS_BUCKET'),
    //         'url' => env('AWS_URL'),
    //         'endpoint' => env('AWS_ENDPOINT'),
    //     ],

    //     'public_uploads' => [
    //         'driver' => 'local',
    //         // 'root'   => '/storage',
    //         'root'   => storage_path() . '/ssd3/638/14213638',
    //         'visibility' => 'public_html',
    //     ],

    // ],

    // /*
    // |--------------------------------------------------------------------------
    // | Symbolic Links
    // |--------------------------------------------------------------------------
    // |
    // | Here you may configure the symbolic links that will be created when the
    // | `storage:link` Artisan command is executed. The array keys should be
    // | the locations of the links and the values should be their targets.
    // |
    // */

    // 'links' => [
    //     public_path('public_html') => storage_path('public_uploads'),
    //     public_path('storage') => storage_path('/ssd3/638/14213638'),
    // ],
];
