<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 09/06/2017
 * Time: 22:18
 */

namespace FormBuilder;

use \Framework\FormBuilder;
use \Framework\FormStringField;
use \Framework\FormTextField;
use \Framework\FormMaxLengthValidator;
use \Framework\FormNotNullValidator;

class BoardgameFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new FormStringField([
            'label' => 'Nom du jeu',
            'name' => 'name',
            'maxlength' => 50,
            'validators' => [
                new FormMaxLengthValidator('Nom trop long', 50),
                new FormNotNullValidator('Nom nul'),
            ],
        ]));
    }
}