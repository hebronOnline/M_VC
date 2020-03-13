<?php
/**
 * This class handles all inititalises the architecuture.
 */

namespace App\M_Core;

class Core {

    /**
     * This function initialises and starts the application;
     */
    public static function init() {
        self::config();
        self::dispatch();
    }

    /**
     * This function dispaches the request to the router
     */
    public static function dispatch() {
        
        $Router = new Router();
        $Router->route();
    }

    /**
     * This function configures all constants related to folders in the app
     */
    public static function config() {
        define('PHP_ROOT', dirname(__FILE__, 3) . '/');
        define('APP', PHP_ROOT . 'App/');
        define('CONTROLLERS', APP . 'Controller/' );
        define('VIEWS', APP . 'View/');
        define('APP_ROOT_FOLDER_NAME', 'QNoMore_App');
        define('ASSETS', '../../src/Assets/');
        define('ASSETS_VIEW', '../src/Assets/');
    }
}