<?php

/**
 * This class handles all string manipulation functions.
 */

namespace App\Utils;

class Text
{
    /**
     * Puts space in between a string characters.
     * 
     * @param string $string is the string you want to put space in it's characters.
     * 
     * @return string the formatted string.
     */
    public static function spaceString($string)
    {
        return implode(' ', str_split($string));
    }

    /**
     * Used to cut out text in a long string
     * 
     * @param string $text is the text you want to truncate
     * @param int $chars is the length you want your truncated string to be.
     * 
     * @return string is the truncated with the specified $chars length  
     */

    public static function truncate($text, $chars = 25)
    {
        if (strlen($text) <= $chars) {
            return $text;
        }

        $text = $text . " ";
        $text = substr($text, 0, $chars);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text . "...";

        return $text;
    }
}
