<?php
// config/admin_menu.php
return [
    [
        'label' => 'Dashboard',
        'icon'  => '🏠',
        'route' => 'admin.dashboard',
        'can'   => null, // لأي مستخدم داخل جروب الأدمن
        'match' => ['admin.dashboard'],
    ],
    [
        'label' => 'Patients',
        'icon'  => '👤',
        'route' => 'patients.index',
        'can'   => 'patients.view',
        'match' => ['patients.*'],
    ],
    [
        'label' => 'Visits',
        'icon'  => '📝',
        'route' => 'visits.index',
        'can'   => 'visits.view',
        'match' => ['visits.*'],
    ],
    [
        'label' => 'Prescriptions',
        'icon'  => '💊',
        'route' => 'prescriptions.index',
        'can'   => 'visits.view',
        'match' => ['prescriptions.*'],
    ],
    [
        'label' => 'Labs',
        'icon'  => '🧪',
        'route' => 'labs.index',
        'can'   => 'labs.manage',
        'match' => ['labs.*'],
    ],
    [
        'label' => 'Files',
        'icon'  => '📎',
        'route' => 'files.index',
        'can'   => 'files.manage',
        'match' => ['files.*'],
    ],
    [
        'label' => 'Settings',
        'icon'  => '⚙️',
        'route' => 'admin.settings',
        'can'   => 'admin.panel',
        'match' => ['admin.settings', 'visit-types.*', 'services.*', 'chronic-diseases.*'],
    ],
];
