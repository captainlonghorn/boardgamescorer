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


class Config extends  ApplicationComponent
{
    protected $vars = [];

    // TODO : Externalize const
    const CONFIG_FILE_NAME = 'app_config.xml';

    public function get($var)
    {
        if (!$this->vars)
        {
            $xml = new \DOMDocument;
            //var_dump($this->app);
            $xml->load(__DIR__.'/../../App/'.$this->app->getName().'/Config/app_config.xml');

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