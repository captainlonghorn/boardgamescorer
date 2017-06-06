<?php

/*
 * Class Manager pour boardgame
 * Responsabilité : Gérer les connexions et les requêtes BDD pour tout ce qui concerne les boardgames
 */

namespace Model;

use \Entity\Boardgame;

class BoardgameManagerPDO extends BoardgameManager
{


    /*
         * GET + CRUD
         */
    // Fetch des données d'un jeu en particulier
    public function getList($debut = -1, $limite = -1)
    {
        // préparation de la requête
        $query = $this->dao->prepare('
            SELECT g.id, g.name AS gamename, g.is_extension, 
                a.firstname, a.lastname, e.name AS editorname
            FROM boardgames g
                INNER JOIN people a ON(a.id = g.author_id and a.is_author IS TRUE)
                INNER JOIN editors e ON(e.id = g.editor_id)
            ORDER BY g.name ASC'
        );
        if ($debut != -1 || $limite != -1)
        {
            $query .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }

        $listeBoardgames = array();

        if ($query->execute()) {
            while ($result_line = $query->fetch()) {
                $boardgame_data = $result_line;
                $boardgame = new Boardgame($boardgame_data);
                $listeBoardgames[] = $boardgame;

            }
            return ($listeBoardgames);
        } else {
            trigger_error('Unable to build boardgame list (blm10)', E_USER_WARNING);
            return false;
        }
    }

}