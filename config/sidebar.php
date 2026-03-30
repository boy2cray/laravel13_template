<?php

return [
    'menus' => [
        [
            'title' => 'Dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'route' => 'dashboard', // path url
            'roles' => ['su','admin','user'], // siapa saja yang bisa lihat
        ],
        [
            'title' => 'Database',
            'icon' => 'fas fa-database',
            'roles' => ['su',],
            'submenu' => [
                ['title' => 'Data karyawan', 'route' => 'karyawan'],
                ['title' => 'Data Admin', 'route' => 'admin'],
            ]
        ],
        
    ]
];