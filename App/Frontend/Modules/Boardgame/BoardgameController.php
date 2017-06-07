<?php

/**
 * Created by PhpStorm.
 * User: David
 * Date: 06/06/2017
 * Time: 22:49
 */

namespace App\Frontend\Modules\Boardgame;

use Framework\BackController;
use Framework\HTTPRequest;

class BoardgameController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
       // On ajoute une définition pour le titre.
        $this->page->addVar('title', 'Bienvenue');

    }

    public function executeListe(HTTPRequest $request)
    {
        $nb_games = $this->app->getConfig()->get('nb_games_index');

        // On ajoute une définition pour le titre.
        $this->page->addVar('title', 'Boardgames shortlist');

        // On récupère le manager.
        $manager = $this->managers->getManagerOf('Boardgame');

        $listeBoardgames = $manager->getList(0, $nb_games);
        //var_dump($listeBoardgames);

        // On ajoute la variable $liste à la vue.
        $this->page->addVar('listeBoardgames', $listeBoardgames);
    }
}