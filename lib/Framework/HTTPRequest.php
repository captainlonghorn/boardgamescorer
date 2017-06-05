<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 05/06/2017
 * Time: 15:41
 */

namespace Framework;

class HTTPRequest extends ApplicationComponent
{
    /*
     * Cookies
     */

    public function cookieExists(string $key) :bool
    {
        if (isset($_COOKIE[$key])) {
            return true;
        }
        return false;
    }

    public function cookieData(string $key) :string
    {
        if ($this->cookieExists($key)) {
            return $_COOKIE[$key];
        }
        return null;
    }

    /*
     * Retrieve Request Method and URI
     */

    public function method() :string
    {
        return $_SERVER['REQUEST_METHOD'];
    }


    public function requestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /*
     * GET
     */

    public function getExists(string $key) :bool
    {
        if (isset($_GET[$key])) {
            return true;
        }
        return false;
    }

    public function getData(string $key) :string
    {
        if ($this->getExists($key)) {
            return $_GET[$key];
        }
        return null;
    }

    /*
     * POST
     */

    public function postExists(string $key) :bool
    {
        if (isset($_POST[$key])) {
            return true;
        }
        return false;
    }

    public function postData(string $key) :string
    {
        if ($this->postExists($key)) {
            return $_POST[$key];
        }
        return null;
    }




}