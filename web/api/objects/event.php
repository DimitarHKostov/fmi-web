<?php

class Event {
    private $name;
    private $beneficier;
    private $iban;
    private $description;

    public function __construct($name, $beneficier, $iban, $description) {
        $this->name = $name;
        $this->beneficier = $beneficier;
        $this->iban = $iban;
        $this->description = $description;
    }

    public function getName() {
        return $this->name;
    }

    public function getBeneficier() {
        return $this->beneficier;
    }

    public function getIban() {
        return $this->iban;
    }

    public function getDescription() {
        return $this->description;
    }

    public static function constructOutOfJson($data) {
        $name = $data['name'];
        $beneficier = $data['beneficier'];
        $iban = $data['iban'];
        $description = $data['description'];

        return new Event($name, $beneficier, $iban, $description);
    }
}