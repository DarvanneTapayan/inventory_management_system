<?php
// RBAC configuration
return [
    'roles' => [
        'admin' => [
            'manage_users',
            'manage_products',
            'manage_orders',
            'view_reports'
        ],
        'user' => [
            'view_products',
            'place_order',
            'view_own_orders',
            'edit_profile'
        ]
    ],

    // Default role for new users
    'default_role' => 'user'
];
?>
