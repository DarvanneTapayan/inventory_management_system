<?php
require_once '../app/classes/User.php';

class UserController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function register($username, $password, $email, $phone) {
        return $this->user->register($username, $password, $email, $phone);
    }

    public function login($username, $password) {
        return $this->user->login($username, $password);
    }

    public function updateProfile($username, $email, $phone) {
        return $this->user->updateProfile($username, $email, $phone);
    }

    public function getUserById($userId) {
        return $this->user->getUserById($userId);
    }

    public function getAllUsers() {
        return $this->user->getAllUsers();
    }

    public function deleteUser($userId) {
        return $this->user->delete($userId);
    }
    public function getUsernameById($userId) {
        $user = $this->user->getUserById($userId);
        return $user ? $user['username'] : 'Unknown'; // Return username or 'Unknown' if user not found
    }
    
}
?>
