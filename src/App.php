<?php
namespace Bijou;

use Bijou\Container;

class App
{
    /**
     * @var Bijou\Container instance */
    private $container = NULL;

    /**
     * @var Bijou\App instance 
     * @static */
    private static $instance = NULL;

    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * App factory creation function
     *
     * @return Bijou\App
     */
    public static function create() : App
    {
        if(is_null(self::$instance))
        {
            return new App;
        }else
        {
            return self::$instance;
        }
    }

    public static function getInstance()
    {
        return self::$instance;
    }

    /**
     * Start the application.
     */
    public function run()
    {
        $router = $this->container()->get('router');

        $router->get("/", function()
        {
            $this->container()->get('view')->render('hello');
        });

        $router->get("/signup", function()
        {
            $this->container()->get('view')->render('form');
        });

        $router->post("/form", function()
        {
            dump($this->container()->get('request')->name);
            dump($this->container()->get('request')->age);
        });
    }

    /**------------------------------------------------------------------------------
     * Magic Methods
     ------------------------------------------------------------------------------*/

    public function __call($name, $arguments)
    {
        // Call to the the PHPDI container specifically.
        if($name == "container")
        {
            return $this->container->getContainer();
        }
    }
}
