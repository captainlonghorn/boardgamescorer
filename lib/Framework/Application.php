<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 05/06/2017
 * Time: 15:37
 * --
 * This is the abstract main class application, to describe how applications will run (frontend and backend)
 *
 */

namespace Framework;


abstract class Application
{
    protected $HTTPRequest;
    protected $HTTPResponse;
    protected $name;

    public function __construct()
    {
        $this->httpRequest = new HTTPRequest;
        $this->httpResponse = new HTTPResponse;
        // name will be passed by extended class (frontend or backend)
        $this->name = '';
    }

    abstract public function run() :void;

    /*
     * GETTERS
     */

    public function getHttpRequest()
    {
        return $this->httpRequest;
    }

    public function getHttpResponse()
    {
        return $this->httpResponse;
    }

    public function getName() :string {
        return $this->name;
    }
}