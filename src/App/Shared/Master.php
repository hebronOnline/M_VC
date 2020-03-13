<?php

/**
 * This class acts as a mster layout fore html you want to reuse, like your template that you want to drag accross 
 * all your pages and just have different content
 * 
 * You can add functions in this class to customise your own master alyout or add as many classes as this as you want in the project
 */

namespace App\Shared\Layout;

class MasterLayout {
    private $PageTitle;

    public function __construct($PageTitle) {
        $this->PageTitle = $PageTitle;
    }

    /**
     * This function should return the page title used when instantiating the class
     */
    private function getTitle() {
        return $this->PageTitle;
    }

    public function AddHeader() {
        ?>
        <html>
        <head>
            <title>
                <?php echo $this->getTitle();?>
            </title>
        </head>
        <body>
    <?php }

    public static function AddFooter() { ?>        
        </body>
        </html>

        <?php
    }
}

?>