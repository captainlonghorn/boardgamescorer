<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 06/06/2017
 * Time: 21:03
 * --
 * classe qui gérera les managers : j'ai nommé Managers.
 * Nous instancierons donc cette classe au sein de notre contrôleur en lui passant le DAO.
 * Les méthodes filles auront accès à cet objet et pourront accéder aux managers facilement.
 */

namespace Framework;


class Managers
{
    protected $api = null;
    protected $dao = null;
    protected $managers = [];

    public function __construct($api, $dao)
    {
        $this->api = $api;
        $this->dao = $dao;
    }

    public function getManagerOf($module)
    {
        if (!is_string($module) || empty($module))
        {
            throw new \InvalidArgumentException('Unknown module');
        }

        if (!isset($this->managers[$module]))
        {
            $manager = '\\Model\\'.$module.'Manager'.$this->api;

            $this->managers[$module] = new $manager($this->dao);
        }

        return $this->managers[$module];
    }
}