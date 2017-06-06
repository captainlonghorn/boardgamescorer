<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 06/06/2017
 * Time: 21:06
 */

namespace Framework;


class PDOFactory
{
    public static function getMysqlConnexion()
    {
        // TODO : externalise consts
        $db = new \PDO('mysql:host=localhost;dbname=boardgame_scorer', 'root', '');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}