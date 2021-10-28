<?php
namespace Bijou;

/**
 * Wrapper/abstraction class for a request.
 */
class Request
{
    public $path = NULL;

    public function __construct()
    {
        $this->path = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];

        if(array_key_exists("QUERY_STRING", $_SERVER))
        {
            $this->queryString = $_SERVER["QUERY_STRING"];
        }
    }

    /**
     * Is the current request GET or not?
     *
     * @return bool
     */
    public function isGet() : bool
    {
        return $this->method == "GET" ?? false;
    }

    /**
     * Is the current request POST or not?
     *
     * @return bool
     */
    public function isPost() : bool
    {
        return $this->method == "POST" ?? false;
    }

    //public function __set($name, $value)
    //{
        //$this->$name = $value;
    //}

    public function __get($name)
    {
        if($this->isPost())
        {
            // After check for POST, set the $name variable to a property
            // on the Request class as if it was already defined on it.
            $this->$name = htmlentities(trim($_POST[$name]));
            return $this->name;
        }
    }
}


