<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 05/06/2017
 * Time: 16:21
 * --
 * This class is used by application components (classes) to obtain the app to witch objects belong
 */

namespace Framework;


abstract class ApplicationComponent
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function app()
    {
        return $this->app;
    }
}