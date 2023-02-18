<?php

class Chain {
    public static function apply(...$args) {
        foreach ($args as $arg) {
            if(!$arg->passGuard()) {
                return false;
            }
        }

        return true;
    }
}