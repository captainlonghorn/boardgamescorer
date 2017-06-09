<?php

/**
 * Created by PhpStorm.
 * User: David
 * Date: 06/06/2017
 * Time: 22:49
 */

namespace App\Frontend\Modules\Boardgame;

use Entity\Boardgame;
use FormBuilder\BoardgameFormBuilder;
use Framework\BackController;
use Framework\HTTPRequest;
use Framework\FormHandler;

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


    public function executeInsertBoardgame(HTTPRequest $request)
    {
        // Si le formulaire a été envoyé.
        if ($request->method() == 'POST') {
            $boardgame = new Boardgame([
                'boardgame' => $request->getData('boardgame'),
                'nom' => $request->postData('name')
            ]);
        } else {
            $boardgame = new Boardgame(array());
        }

        $formBuilder = new BoardgameFormBuilder($boardgame);
        $formBuilder->build();

        $form = $formBuilder->getForm();

        if ($request->method() == 'POST' && $form->isValid()) {
            //$this->managers->getManagerOf('Boardgame')->save($boardgame);

            // On récupère le gestionnaire de formulaire (le paramètre de getManagerOf() est bien entendu à remplacer).
            $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'),
                $request);

            if ($formHandler->process()) {
                // Ici ne résident plus que les opérations à effectuer une fois l'entité du formulaire enregistrée
                // (affichage d'un message informatif, redirection, etc.).
            }
            $this->app->user()->setFlash('Le jeu a bien été ajouté, merci !');
            $this->app->httpResponse()->redirect('news-' . $request->getData('boardgame') . '.html');
        }

        $this->page->addVar('boardgame', $boardgame);
        $this->page->addVar('form', $form->createView());
        $this->page->addVar('title', 'Ajout d\'un jeu');
    }
}