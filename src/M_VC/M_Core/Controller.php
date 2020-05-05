<?php
/**
 * This class handles all Controller core functions.
 */

namespace App\M_Core;

abstract class Controller {
    //request params
    protected $request;

    function __construct() {
        $method = $_SERVER['REQUEST_METHOD'];
        
        //Get all reuest aorameters and store the in $request
        if ($method == "POST") {
            foreach ($_POST as $key => $value) {
                $this->request[$key] = $value;
            }
            
            foreach ($_FILES as $key => $value) {
                $this->request[$key] = $value;
            }
        } else {
            foreach ($_GET as $key => $value) {
                $this->request[$key] = $value;
            }
        }
    }

    /**
     * This function renders a view after all processing is done in the controller.
     * @param string $view is the name of the view age you want to show after processing is done.
     * @param array $args is the array you want to pass to the view
     */
    protected function showView($view, $args = null) {
        if ($args <> null) {
            foreach ($args as $vname => $vvalue) {
                $$vname = $vvalue;
            }
        }

		require_once(VIEWS . $view.'.php');
    }
    
    /**
     * This function returns a json object from an array.
     * @param array $response is the array you want to return as a JSON object.
     * @param array $code is the status code of the response.
     */

    protected function json_response($response, $code = 200) {
        header("HTTP/1.1 " . $code);
        echo json_encode($response);
    }
}