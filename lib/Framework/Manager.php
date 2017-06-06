<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 06/06/2017
 * Time: 21:10
 * --
 * Tous les managers devront donc hériter de Manager
 * et chaque entité de Entity. La classe Manager se chargera
 * d'implémenter un constructeur qui demandera le DAO par le biais d'un paramètre
 */

namespace Framework;


abstract class Manager
{
    protected $dao;

    public function __construct($dao)
    {
        $this->dao = $dao;
    }
}