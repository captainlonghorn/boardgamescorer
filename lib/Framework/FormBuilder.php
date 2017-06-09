<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 09/06/2017
 * Time: 21:55
 */

namespace Framework;


abstract class FormBuilder
{
    protected $form;

    public function __construct(Entity $entity)
    {
        $this->setForm(new Form($entity));
    }

    abstract public function build();

    public function setForm(Form $form){
        $this->form = $form;
    }

    public function getForm(){
        return $this->form;
    }
}