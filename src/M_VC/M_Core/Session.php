<?php

/**
 * This class handles all session related functions.
 *
 * @author Hebron Ncabane <muzi.hebron@gmail.com>
 * @github www.github.com/hebronOnline
 * @package M_VC 
 * @version 1.0.3
 * @copyright (c) hebronOnline.co.za 2020
 */

namespace App\M_Core;

class Session
{
    public static function session($key)
    {
        if (is_array($key)) {
            self::set($key);
        } else {
            return self::get($key);
        }
    }

    /**
     * Set a session variables
     * 
     * @param array $arr is an array of a session keys and values pair that you want to set
     * 
     */
    public static function set($arr)
    {
        foreach ($arr as $key => $val) {
            $_SESSION[$key] = $val;
        }
    }


    /**
     * Get a session variable
     * 
     * @param string $key is the session key that you want to retreive
     * 
     * @return value string is the value of the session key that you requested
     */
    public static function get($key)
    {
        return $_SESSION[$key];
    }

    /**
     * Start a session
     */
    public static function start()
    {
        session_start();
    }

    /**
     * destroy a session
     */
    public static function destroy()
    {
        session_destroy();
    }

    /**
     * Validate if a user is logged in.
     * 
     * @param string $location is where you want to redirect the user if the session is invalid.
     */
    public static function validate($location = 'Login')
    {
        if (!isset($_SESSION['logged_in'])) {
            self::destroy();
            header('location: ' . $location);
        }
    }
}
