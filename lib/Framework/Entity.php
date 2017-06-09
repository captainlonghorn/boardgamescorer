<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 06/06/2017
 * Time: 21:13
 * --
 *  la classe Entity est plus complexe. En effet, celle-ci offre quelques fonctionnalités :
 * Implémentation d'un constructeur qui hydratera l'objet si un tableau de
 * valeurs lui est fourni.
 * Implémentation d'une méthode qui permet de
 * vérifier si l'enregistrement est nouveau ou pas.
 * Pour cela, on vérifie si l'attribut $id est vide ou non
 * (ce qui inclut le fait que toutes les tables devront posséder un champ nommé id).
 * Implémentation des getters / setters.
 *
 * Implémentation de l'interface ArrayAccess (ce n'est pas obligatoire, c'est juste que je préfère utiliser l'objet comme un tableau dans les vues).
 */

namespace Framework;


abstract class Entity
{
    // Hydrator is now in a trait
    use Hydrator;

    protected $erreurs = [],
        $id;

    public function __construct(array $donnees = [])
    {
        if (!empty($donnees))
        {
            $this->hydrate($donnees);
        }
    }

    public function isNew()
    {
        return empty($this->id);
    }

    public function getErreurs()
    {
        return $this->erreurs;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function offsetGet($var)
    {
        if (isset($this->$var) && is_callable([$this, $var]))
        {
            return $this->$var();
        }
    }

    public function offsetSet($var, $value)
    {
        $method = 'set'.ucfirst($var);

        if (isset($this->$var) && is_callable([$this, $method]))
        {
            $this->$method($value);
        }
    }

    public function offsetExists($var)
    {
        return isset($this->$var) && is_callable([$this, $var]);
    }

    public function offsetUnset($var)
    {
        throw new \Exception('Impossible de supprimer une quelconque valeur');
    }
}