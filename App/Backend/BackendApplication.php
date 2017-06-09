<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 09/06/2017
 * Time: 21:15
 */

namespace App\Backend;

use Framework\Application;

class BackendApplication extends Application
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Backend';
    }

    public function run()
    {
        if ($this->user->isAuthenticated())
        {
            $controller = $this->getController();
        }
        else
        {
            $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');
        }

        $controller->execute();

        $this->httpResponse->setPage($controller->getPage());
        $this->httpResponse->send();
    }
}