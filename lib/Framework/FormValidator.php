<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 09/06/2017
 * Time: 22:05
 */

namespace Framework;


abstract class FormValidator
{
    protected $errorMessage;


    /**
     * FormValidator constructor.
     */
    public function __construct(string $errorMessage)
    {
        $this->setErrorMessage($errorMessage);
    }

    abstract function isValid($value);

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param mixed $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

}