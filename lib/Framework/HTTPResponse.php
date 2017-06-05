<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 05/06/2017
 * Time: 16:05
 */

namespace Framework;


class HTTPResponse
{
    private $page;

    public function addHeader(string $header) :void
    {
        header($header);
    }

    public function redirect(string $location) :void
    {
        header('Location :' . $location);
        exit();
    }

    public function redirect404() :void
    {
        // TODO : The function code
    }

    public function send() :void
    {
        exit($this->page->getGeneratedPage());
    }

    public function setPage(Page $page)
    {
        $this->page = $page;
    }

    // This change is made instead of original function setcookie() : last argument is true by default
    public function setCookie(
        $name,
        $value = '',
        $expire = 0,
        $path = null,
        $domain = null,
        $secure = false,
        $httpOnly = true
    ) :void
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
}