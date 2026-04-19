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
        [
            'title' => 'Menu Level 1',
            'icon' => 'fas fa-database',
            'roles' => ['su',],
            'submenu' => [
                ['title' => 'Menu Level 2', 'route' => '#'],
                ['title' => 'Menu Level 2', 'route' => '#'],
                [
                    'title' => 'Menu dengan Level 3',
                    'child' => [
                        ['title' => 'Menu Level 3', 'route' => '#'],
                        ['title' => 'Menu Level 3', 'route' => '#'],
                    ]
                ],
                
            ]
        ],
        
    ]
];