<?php

abstract class PasswordVerifier {
    public static function verify($password, $hash) {
        return password_verify($password, $hash);
    }
}