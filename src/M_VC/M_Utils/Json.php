<?php
/** 
 * This class handles all json related functions.
 * 
 * @author Hebron Ncabane <muzi.hebron@gmail.com>
 * @github www.github.com/hebronOnline
 * @package M_VC 
 * @version 1.0.3
 * @copyright (c) 2020 www.hebronOnline.co.za
 */

namespace App\Utils;

class Json
{
    /**
     * Reads a json file
     * 
     * @param string $filename is the json file you want to read.
     * 
     * @return array an array of the json file contents
     */
    public static function readFile(string $filename)
    {
        if (file_exists(FILES . $filename)) {
            $content = file_get_contents(FILES . $filename);
        } else return null;

        return json_decode($content, true);
    }

    /**
     * Writes contents of an array into a json file
     * 
     * @param array $content is the array you want to write into a json file.
     * @param string $file is the name of the file you want to save the json as.
     * 
     */
    public static function writeFile(array $contents, string $file)
    {
        $fp = fopen(FILES . $file, 'w');
        fwrite($fp, json_encode($contents));
        fclose($fp);

        return true;
    }
}