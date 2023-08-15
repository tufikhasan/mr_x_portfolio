<?php

namespace App\Helpers;

class Helper {
    public static function static_path( string $path ) {
        return public_path($path);
        // return $path;
    }
}