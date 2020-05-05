<?php

/**
 * This class handles all mathametical functions.
 */

namespace App\Utils;

class Math {

    /**
     * Formats a number in to a currency with 2 demical spaces and a space as thousand seperator.
     * 
     * @param string $number is the number you wna tot format into a currency.
     * 
     * @return string the number formatted as a currency.
     */
    public static function formatCurrency($number) {
        return 'R ' . number_format($number, 2, '.', ' ');
    }
}