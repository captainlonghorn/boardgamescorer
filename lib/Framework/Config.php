<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 06/06/2017
 * Time: 21:50
 * --
 * 
 */

namespace Framework;


class Config
{
    protected $vars = [];

    // TODO : Externalize const
    const CONFIG_FILE_NAME = 'app_config.xml';

    public function get($var)
    {
        if (!$this->vars)
        {
            $xml = new \DOMDocument;
            $xml->load(__DIR__.'/../../App/'.$this->app->name().'/Config/'.CONFIG_FILE_NAME);

            $elements = $xml->getElementsByTagName('define');

            foreach ($elements as $element)
            {
                $this->vars[$element->getAttribute('var')] = $element->getAttribute('value');
            }
        }

        if (isset($this->vars[$var]))
        {
            return $this->vars[$var];
        }

        return null;
    }
}