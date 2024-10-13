<?php
// General configuration
return [
    'app_name' => 'Inventory Management System',
    'base_url' => 'http://localhost/inventory_management_system/',

    // Database configuration
    'database' => [
        'host' => 'localhost',
        'db_name' => 'inventory_management_system',
        'username' => 'root',
        'password' => '',
    ],

    // Security settings
    'security' => [
        'password_hash_algo' => PASSWORD_BCRYPT,
    ]
];
?>
