<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 06/06/2017
 * Time: 22:02
 */

namespace App\Frontend;

use \Framework\Application;

class FrontendApplication extends Application
{
    public function __construct()
    {
        // Application instanciation
        parent::__construct();
        // Declare application name
        $this->name = 'Frontend';
    }

    public function run()
    {
        //echo '123';
        $controller = $this->getController();
        //var_dump($controller);
        $controller->execute();

        $this->httpResponse->setPage($controller->getPage());
        $this->httpResponse->send();
    }

}