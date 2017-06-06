<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 06/06/2017
 * Time: 21:27
 * --
 * Managing visitor
 */

namespace Framework;

session_start();

class User
{
    public function getAttribute($attr) :string
    {
        if (isset($_SESSION[$attr])) {
            return $_SESSION[$attr];
        }
        return null;
    }

    public function getFlash() :string
    {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    public function hasFlash() :bool
    {
        return isset($_SESSION['flash']);
    }

    public function isAuthenticated() :bool
    {
        return (isset($_SESSION['auth']) && $_SESSION['auth'] === true);
    }

    public function setAttribute($attr, $value) :void
    {
        $_SESSION[$attr] = $value;
    }

    public function setAuthenticated($authenticated = true) :void
    {
        if (!is_bool($authenticated))
        {
            throw new \InvalidArgumentException('Value for User::setAuthenticated() must be boolean');
        }

        $_SESSION['auth'] = $authenticated;
    }

    public function setFlash($value) :void
    {
        $_SESSION['flash'] = $value;
    }
}