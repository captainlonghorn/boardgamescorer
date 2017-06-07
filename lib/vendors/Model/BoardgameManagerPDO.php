<?php

/*
 * Class Manager pour boardgame
 * Responsabilité : Gérer les connexions et les requêtes BDD pour tout ce qui concerne les boardgames
 */

namespace Model;

use \Entity\Boardgame;
use Entity\BoardgameCollection;

class BoardgameManagerPDO extends BoardgameManager
{


    /*
         * GET + CRUD
         */
    // Fetch des données d'un jeu en particulier
    public function getList($debut = -1, $limite = -1)
    {
        // préparation de la requête
        $sql = '
            SELECT 
                `id`, 
                `name`, 
                `author_id`,
                `author_second_id`, 
                `editor_id`, 
                `description`, 
                `is_extension`, 
                `is_collaborative`, 
                `has_invert_score`, 
                `img_url` 
            FROM `boardgames`
            ORDER BY `name` ASC';
        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $stmt = $this->dao->prepare($sql);
        // todo : a quickiest way to do this ? FETCH_CLASS ?
        if ($stmt->execute()) {
            while ($result_line = $stmt->fetch()) {
                $boardgame_data[] = $result_line;
            }
            // object collection
            $BoardgameCollection = new BoardgameCollection($boardgame_data);
            return $BoardgameCollection;
        } else {
            trigger_error('Unable to build boardgame list (blm10)', E_USER_WARNING);
            return false;
        }
    }

}