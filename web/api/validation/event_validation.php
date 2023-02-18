<?php

define("NAME_REGEX_PATTERN", "/^[a-zA-Z]+$/");
define("BENEFICIER_REGEX_PATTERN", '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/');
define("IBAN_REGEX_PATTERN", "/^[A-Z\d]{2,30}$/");
define("DESCRIPTION_REGEX_PATTERN", '/^[a-zA-Z0-9\s]+$/');

class EventValidation extends Validation{
    private $event;

    public function __construct($event) {
        $this->event = $event;
    }

    public function passGuard() {
        return $this->validateName($this->event->getName()) && $this->validateBeneficier($this->event->getBeneficier()) && $this->validateIban($this->event->getIban()) && $this->validateDescription($this->event->getDescription());
    }

    private function validateName($name) {
        return preg_match(NAME_REGEX_PATTERN, $name);
    }

    private function validateBeneficier($beneficier) {
        return preg_match(BENEFICIER_REGEX_PATTERN, $beneficier);
    }

    private function validateIban($iban) {
        return preg_match(IBAN_REGEX_PATTERN, $iban);
    }

    private function validateDescription($description) {
        return preg_match(DESCRIPTION_REGEX_PATTERN, $description);
    }
}