<?php

/**
 * This is a example controller class which handles all request from the view and passes them to the view
 */

namespace App\Controller;

use App\M_Core\Controller;
use App\Model\UserModel;

class HomeController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    //If no ladning page is set for the controller the index funtion will be the default funciton.
    public function Index()
    {
        echo "This is the index";
    }

    //Retrieving data from the database.
    public function UserProfile($params)
    {
        $UserModel = new UserModel;
        $User = $UserModel->getUser($params['username']);

        return $this->showView("UserProfile", $User);
    }

    //Returning a json response to an ajax or HTTP request.
    public function getJson()
    {
        $arr = ['name' => 'Herbon', 'surname' => 'Ncabane'];

        return $this->json_response($arr);
    }

    //This function gets a parameter from the request URI and passes it back to to view for demostration.
    public function Hello($params)
    {
        $var['name'] = $params[0];
        return $this->showView('Hello', $var);
    }
}
