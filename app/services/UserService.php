<?php
require_once '../app/classes/User.php';

class UserService {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function createUser($username, $password, $email, $phone) {
        return $this->user->register($username, $password, $email, $phone);
    }

    public function updateUser($userId, $email, $role) {
        return $this->user->updateUser($userId, $email, $role);
    }

    public function deleteUser($userId) {
        return $this->user->delete($userId);
    }

    public function getAllUsers() {
        return $this->user->getAllUsers();
    }

    public function getUserById($userId) {
        return $this->user->getUserById($userId);
    }
}
?>
