<?php
/**
 * This class handles all string manipulation functions.
 */
namespace App\Utils;

class Text {
    /**
     * Puts space in between a string characters.
     * 
     * @param string $string is the string you want to put space in it's characters.
     * 
     * @return string the formatted string.
     */
    public static function spaceString($string) {
        return implode(' ', str_split($string)); 
    }
}