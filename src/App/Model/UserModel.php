<?php

/**
 * Models like this inherit all database functions from the Model class and are 
 * used to retrieve data for controllers in the app.
 */

namespace App\Model;

use App\M_Core\Model;

class UserModel extends Model {

    /**
     * This i s class demostrating how to use the Model to retrieve data from the database and return it to the view
     * 
     * @param string $username a parameter to be passed from the controller
     */

    public function getUser($username) {
        $strSql = "SELECT * FROM user WHERE username = :username";
        $arrSql = [':username' => $username];

        $User = $this->SELECT($strSql, $arrSql, true);

        return $User;
    }
}