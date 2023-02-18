<?php

define("USERNAME_REGEX_PATTERN", "/^[a-zA-Z0-9]{6,30}$/");
define("PASSWORD_REGEX_PATTERN", '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d])[A-Za-z\d!@#$%^&*(){}[\]<>,.?\/:;\'\"|_+=~`-]{6,30}$/');

class LoginValidation extends Validation{
    private $loginData;

    public function __construct($loginData) {
        $this->loginData = $loginData;
    }

    public function passGuard() {
        return $this->validateUsername($this->loginData->getUsername()) && $this->validatePassword($this->loginData->getPassword());
    }

    private function validateUsername($username) {
        return preg_match(USERNAME_REGEX_PATTERN, $username);
    }

    private function validatePassword($password) {
        return preg_match(PASSWORD_REGEX_PATTERN, $password);
    }
}