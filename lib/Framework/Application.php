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
    protected $user;
    protected $config;

    public function __construct()
    {
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        // name will be passed by extended class (frontend or backend)
        $this->name = '';
        $this->user = new User($this);
        $this->config = new Config($this);
    }

    abstract public function run();

    public function getController()
    {
        $router = new Router;

        $xml = new \DOMDocument;
        $xml->load(__DIR__ . '/../../App/' . $this->name . '/Config/routes.xml');

        $routes = $xml->getElementsByTagName('route');

        // routes (XML)
        foreach ($routes as $route) {
            $vars = [];

            // does URL have variables ?
            if ($route->hasAttribute('vars')) {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            // add route to router
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'),
               $route->getAttribute('action'), $vars));

        }

        try {
            // retrieve route corresponding to URL
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        } catch (\RuntimeException $e) {
            if ($e->getCode() == Router::NO_ROUTE) {
                // if no route, page does not exists
                $this->httpResponse->redirect404();
            }
        }

        // URL variables are added to $_GET
        $_GET = array_merge($_GET, $matchedRoute->vars());

        // Controler instanciation
        $controllerClass = 'App\\' . $this->name . '\\Modules\\' . $matchedRoute->module() . '\\' . $matchedRoute->module() . 'Controller';
        return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
    }

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

    public function getName() :string
    {
        return $this->name;
    }

    public function getUser() :User
    {
        return $this->user;
    }

    public function getConfig() :Config
    {
        return $this->config;
    }
}