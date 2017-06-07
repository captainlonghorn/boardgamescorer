<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 06/06/2017
 * Time: 21:18
 * --
 *
 */

namespace Framework;


class Page extends ApplicationComponent
{
    protected $contentFile;
    protected $vars = [];

    public function addVar($var, $value)
    {
        if (!is_string($var) || is_numeric($var) || empty($var))
        {
            throw new \InvalidArgumentException('Var name must be a not null string');
        }

        $this->vars[$var] = $value;
        var_dump($this->vars);
    }

    public function getGeneratedPage()
    {
        echo 'ggp';
        if (!file_exists($this->contentFile))
        {
            throw new \RuntimeException('View does not exist');
        }
        
        $user = $this->app->getUser();

        // Create array containing variables and their values
        extract($this->vars);

        ob_start();
        // TODO : below are 2 weird points
        require $this->contentFile;
        var_dump($this->contentFile);
        $content = ob_get_clean();

        ob_start();
        require __DIR__.'/../../App/'.$this->app->getName().'/Templates/layout.php';
        return ob_get_clean();
    }

    public function setContentFile($contentFile)
    {
        if (!is_string($contentFile) || empty($contentFile))
        {
            throw new \InvalidArgumentException('Unknown view');
        }

        $this->contentFile = $contentFile;
    }
}