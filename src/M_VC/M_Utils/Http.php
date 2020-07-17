<?php

/**
 * This class will handle all Http requests
 * 
 * @author Hebron Ncabane <muzi.hebron@gmail.com>
 * @github www.github.com/hebronOnline
 * @package M_VC 
 * @version 1.0.3
 * @copyright (c) 2020 www.hebronOnline.co.za
 */

namespace App\Utils;

class Http
{
    /**
     *	This function is used to make a GET request without headers
     *
     *	@param string $url - The url of the server you want to make a request to, including query parameters
     *
     *	@return array $Result
     */
    public static function GET($url)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $Response   = curl_exec($curl);
        $Result     = json_decode($Response, true);

        curl_close($curl);

        return $Result;
    }

    /**
     *	This function is used to make a POST request without headers
     *
     *	@param string $url - The url of the server you want to make a request to, including query parameters
     *	@param array $data - The data you want to POST to the server as an array of keys and values
     *
     *	@return array $Result - Response result from the server
     */
    public static function POST($url, $data)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

        $Response   = curl_exec($curl);
        $Result     = json_decode($Response, true);

        curl_close($curl);

        return $Result;
    }

    /**
     *	This function is used to make a POST request with headers for authentication 
     *
     *	@param string $url - The url of the server you want to make a request to, including query parameters
     *	@param array $data - The data you want to POST to the server as an array of keys and values
     *	@param string $key - The authentication key
     *	@param string $auth - The type of authentication header you want to use
     *	@param boolean $encode - used to specify if the body should be json_encoded or just use normal http query
     *
     *	@return array $Result - Response result from the server
     */

    public static function POSTAUTH($url, $data, $key, $auth = 'DEFAULT', $encode = false)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if (!$encode)
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        else curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $headers = array();

        switch ($auth) {
            case 'CUSTOM':
                $headers[] = "Authentication: " . $key;
                break;
            case 'DEFAULT':
                $headers[] = "Content-Type:application/json";
                $headers[] = "Authorization: " . $key;
                break;
            default:
                $headers[] = "Authorization: " . $key;
                break;
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $Response   = curl_exec($curl);
        $Result     = json_decode($Response, true);

        curl_close($curl);

        return $Result;
    }

    /**
     *	This function is used to make a GET request with headers for authentication 
     *
     *	@param string $url - The url of the server you want to make a request to, including query parameters
     *	@param string $key - The base64 encoded authentication key
     *	@param string $auth - The type of authentication header you want to use
     *	@return array $Result - Response result from the server
     */
    public static function GETAUTH($url, $key, $auth = 'DEFAULT')
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array();

        switch ($auth) {
            case 'CUSTOM':
                $headers[] = "Authentication: " . $key;
                break;
            case 'DEFAULT':
                $headers[] = "Authorization: " . $key;
                break;
            default:
                $headers[] = "Authorization: " . $key;
                break;
        }

        $headers[] = "Content-Type:application/json";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $Response   = curl_exec($curl);
        $Result     = json_decode($Response, true);

        curl_close($curl);

        return $Result;
    }
}
