<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 05/06/2017
 * Time: 16:53
 */

namespace Framework;


class Router
{
    private $routes = array();

    const NO_ROUTE = 1;

    public function addRoute(Route $route)
    {
        if (!in_array($route, $this->routes)) {
            $routes[] = $route;
        }
    }

    public function getRoute(string $url) :Route
    {
        foreach ($this->routes as $route) {
            // Check if current route matches URL
            if (($varsValues = $route->match($url)) !== false) {
                // if route has variables
                if ($route->hasVars()) {
                    $varsNames = $route->varsNames();
                    $listVars = [];

                    // New array key/value
                    // (key = variable name, value = his value)
                    foreach ($varsValues as $key => $match) {
                        // First value contains the entire captured chain, so, need to change key
                        // (see preg_match)
                        if ($key !== 0) {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }
                    // the assign variable array to route
                    $route->setVars($listVars);
                }
                return $route;
            }
        }

        throw new \RuntimeException('No route was found corresponding to URL ' . $url,
            self::NO_ROUTE);
    }
}