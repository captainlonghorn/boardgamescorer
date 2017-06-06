<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 05/06/2017
 * Time: 16:05
 */

namespace Framework;


class HTTPResponse extends ApplicationComponent
{
    private $page;

    public function addHeader(string $header)
    {
        header($header);
    }

    public function redirect(string $location)
    {
        header('Location :' . $location);
        exit();
    }

    public function redirect404() :void
    {
        $this->page = new Page($this->app);
        $this->page->setContentFile(__DIR__.'/../../Errors/404.html');
        $this->addHeader('HTTP/1.0 404 Not Found');
        $this->send();
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