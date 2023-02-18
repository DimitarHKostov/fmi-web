<?php

define("USERNAME_REGEX_PATTERN", "/^[a-zA-Z0-9]{6,30}$/");
define("PASSWORD_REGEX_PATTERN", '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d])[A-Za-z\d!@#$%^&*(){}[\]<>,.?\/:;\'\"|_+=~`-]{6,30}$/');
define("NAME_REGEX_PATTERN", '/^[A-Z][a-z]+$/');
define("EMAIL_REGEX_PATTERN", '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/');

class RegisterValidation extends Validation{
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function passGuard() {
        if($this->user == null) {
            return false;
        }

        $username = $this->user->getUsername();
        $password = $this->user->getPassword();
        $firstName = $this->user->getFirstName();
        $lastName = $this->user->getLastName();
        $email = $this->user->getEmail();

        if($this->nullCheck($username) || $this->nullCheck($password) || $this->nullCheck($firstName) || $this->nullCheck($lastName) || $this->nullCheck($email)) {
            return false;
        }

        if($this->emptyCheck($username) || $this->emptyCheck($password) || $this->emptyCheck($firstName) || $this->emptyCheck($lastName) || $this->emptyCheck($email)) {
            return false;
        }

        return $this->validateUsername($username) && $this->validatePassword($password) && $this->validateFirstName($firstName) && $this->validateLastName($lastName) && $this->validateEmail($email);
    }

    private function validateUsername($username) {
        return preg_match(USERNAME_REGEX_PATTERN, $username);
    }

    private function validatePassword($password) {
        return preg_match(PASSWORD_REGEX_PATTERN, $password);
    }
    
    private function validateFirstName($firstName) {
        return preg_match(NAME_REGEX_PATTERN, $firstName);
    }

    private function validateLastName($lastName) {
        return preg_match(NAME_REGEX_PATTERN, $lastName);
    }

    private function validateEmail($email) {
        return preg_match(EMAIL_REGEX_PATTERN, $email);
    }

    private function nullCheck($str) {
        return $str == null;
    }

    private function emptyCheck($str){
        return $str == "";
    }
}