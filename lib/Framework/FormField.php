<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 09/06/2017
 * Time: 21:50
 */

namespace Framework;


abstract class FormField
{
// On utilise le trait Hydrator afin que nos objets Field puissent être hydratés
    use Hydrator;

    protected $errorMessage;
    protected $label;
    protected $name;
    protected $validators = [];
    protected $value;

    public function __construct(array $options = [])
    {
        if (!empty($options))
        {
            $this->hydrate($options);
        }
    }

    abstract public function buildWidget();

    public function isValid()
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($this->value)) {
                $this->errorMessage = $validator->errorMessage();
                return false;
            }
        }
    }

    public function label()
    {
        return $this->label;
    }

    public function name()
    {
        return $this->name;
    }

    public function value()
    {
        return $this->value;
    }

    public function setLabel($label)
    {
        if (is_string($label))
        {
            $this->label = $label;
        }
    }

    public function setName($name)
    {
        if (is_string($name))
        {
            $this->name = $name;
        }
    }

    public function setValue($value)
    {
        if (is_string($value))
        {
            $this->value = $value;
        }
    }
}