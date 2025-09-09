<?php
return [
    'defaults' => [
        'guard' => 'web',
    ],
    'models' => [
        'permission' => Spatie\Permission\Models\Permission::class,
        'role' => Spatie\Permission\Models\Role::class,
    ],
];
