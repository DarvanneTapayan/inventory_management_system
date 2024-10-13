<?php
require_once '../app/classes/User.php';

class AuthService {
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
}
?>
