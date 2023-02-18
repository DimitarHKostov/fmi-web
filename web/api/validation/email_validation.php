<?php

define("EMAIL_REGEX_PATTERN", '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/');

class EmailValidation extends Validation{
    private $email;

    public function __construct($email) {
        $this->email = $email;
    }

    public function passGuard() {
        return $this->validateEmail($this->email);
    }

    private function validateEmail($email) {
        return preg_match(EMAIL_REGEX_PATTERN, $email);
    }
}