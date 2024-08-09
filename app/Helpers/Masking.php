<?php

namespace App\Helpers;

class Masking {

    public static function number($text, $angkashow, $maskingCharacter = 'x',) {
        $text = substr($text, 0, $angkashow) . str_repeat($maskingCharacter, strlen($text) - $angkashow);
        return $text;
    }
}