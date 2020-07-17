<?php

/**
 * This class handles all inititalises the architecuture.
 * 
 * @author Hebron Ncabane <muzi.hebron@gmail.com>
 * @github www.github.com/hebronOnline
 * @package M_VC 
 * @version 1.0.3
 * @copyright (c) 2020, www.hebronOnline.co.za
 */

namespace App\M_Core;

class Core
{
    /**
     * This function initialises and starts the application;
     */
    public static function init()
    {
        self::config();
        self::dispatch();
    }

    /**
     * This function dispaches the request to the router
     */
    public static function dispatch()
    {

        $Router = new Router();
        $Router->route();
    }

    /**
     * This function configures all constants related to folders in the app
     */
    public static function config()
    {
        define('PHP_ROOT', dirname(__FILE__, 3) . '/');
        define('APP', PHP_ROOT . 'App/');
        define('CONTROLLERS', APP . 'Controller/');
        define('VIEWS', APP . 'View/');
        define('CACHE', APP . 'Cache/');
        define('TEMP', APP . 'temp/');
        define('FILES', APP . 'Files/');
        define('APP_ROOT_FOLDER_NAME', 'M_VC Framework');
        define('ASSETS', '../../src/Assets/');
        define('ASSETS_VIEW', '../src/Assets/');
    }
}
