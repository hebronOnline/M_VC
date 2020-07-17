<?php

/**
 * This class handles connection to the database
 * 
 * @author Hebron Ncabane <muzi.hebron@gmail.com>
 * @github www.github.com/hebronOnline
 * @package M_VC 
 * @version 1.0.3
 * @copyright (c) 2020, www.hebronOnline.co.za 
 */

namespace App\M_Core;

class Database
{
    /**
     * This function returns a database connection
     *
     * @return $Connection The database connection.
     */
    public static function connect()
    {

        $DB_HOST            = 'HOSTNAME'; //hostname
        $DB_USER_ACCOUNT    = 'USERNAME'; // username
        $DB_USER_PASSWORD   = 'PASSWORD'; // password
        $DB_INSTANCE        = 'DATABSE'; //database name

        $Database           = new \PDO("mysql:host=$DB_HOST;dbname=$DB_INSTANCE", $DB_USER_ACCOUNT, $DB_USER_PASSWORD);

        $Database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $Database->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        return $Database;
    }
}
