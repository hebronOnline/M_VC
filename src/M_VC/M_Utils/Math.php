<?php

/** 
 * This class handles all math related functions.
 * 
 * @author Hebron Ncabane <muzi.hebron@gmail.com>
 * @github www.github.com/hebronOnline
 * @package M_VC 
 * @version 1.0.3
 * @copyright (c) 2020 www.hebronOnline.co.za
 */

namespace App\Utils;

class Math
{
    /**
     * Formats a number in to a currency with 2 demical spaces and a space as thousand seperator.
     * 
     * @param string $number is the number you wna tot format into a currency.
     * 
     * @return string the number formatted as a currency.
     */
    public static function formatCurrency($number)
    {
        return 'R ' . number_format($number, 2, '.', ' ');
    }

    /**
     * Rounds off a number to specified demical places.
     * 
     * @param double $number is the number you want to round off.
     * @param int places is the number of decimal places you want your number to hae
     * 
     * @return string rounded off version of the number 
     * 
     */

    public static function round($number, $places = 2)
    {
        return number_format($number, $places, '.', '');
    }
}
