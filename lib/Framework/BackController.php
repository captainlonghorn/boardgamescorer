<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 06/06/2017
 * Time: 20:55
 */

namespace Framework;


abstract class BackController extends ApplicationComponent
{
    protected $action = '';
    protected $module = '';
    protected $page = null;
    protected $view = '';

    protected $managers = array();

    public function __construct(Application $app, $module, $action)
    {
        parent::__construct($app);

        $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());

        $this->page = new Page($app);

        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);
    }

    public function execute()
    {
        $method = 'execute'.ucfirst($this->action);

        if (!is_callable([$this, $method]))
        {
            throw new \RuntimeException('Action "'.$this->action.'" is undefined in this module');
        }

        $this->$method($this->app->httpRequest());
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setModule($module)
    {
        if (!is_string($module) || empty($module))
        {
            throw new \InvalidArgumentException('Module must be a valid string');
        }

        $this->module = $module;
    }

    public function setAction($action)
    {
        if (!is_string($action) || empty($action))
        {
            throw new \InvalidArgumentException('Action must be a valid string');
        }

        $this->action = $action;
    }

    public function setView($view)
    {
        if (!is_string($view) || empty($view))
        {
            throw new \InvalidArgumentException('View must be a valid string');
        }

        $this->view = $view;
        // lorsque l'on change de vue, il faut en informer la page concernée grâce à la méthode setContentFile() de notre classe Page :
        $this->page->setContentFile(__DIR__.'/../../App/'.$this->app->name().'/Modules/'.$this->module.'/Views/'.$this->view.'.php');
    }
}