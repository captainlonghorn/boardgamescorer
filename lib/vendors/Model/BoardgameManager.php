<?php
namespace Model;

use \Framework\Manager;

abstract class BoardgameManager extends Manager
{
    /**
     * Méthode retournant une liste de Boardgames demandée
     * @param $debut int La première Boardgames à sélectionner
     * @param $limite int Le nombre de Boardgames à sélectionner
     * @return array La liste des Boardgames. Chaque entrée est une instance de Boardgames.
     */
    abstract public function getList($debut = -1, $limite = -1);
}