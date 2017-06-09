<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 09/06/2017
 * Time: 22:09
 */

namespace Framework;


class FormNotNullValidator extends FormValidator
{
    public function isValid($value)
    {
        return $value != '';
    }

}