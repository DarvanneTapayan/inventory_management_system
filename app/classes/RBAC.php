<?php
class RBAC {
    private $roles_permissions = [
        'admin' => ['login', 'manage_users', 'manage_products', 'manage_orders'],
        'user' => ['login', 'view_products', 'place_order']
    ];

    public function checkAccess($role, $permission) {
        return in_array($permission, $this->roles_permissions[$role] ?? []);
    }
}
?>
