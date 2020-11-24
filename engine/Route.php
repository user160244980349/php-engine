<?php

namespace Engine;

/**
 * Route.php
 *
 * Class Route contains info about route.
 */
class Route
{

    /**
     * Request method.
     *
     * @access public
     * @var string
     */
    public $name;

    /**
     * Request method.
     *
     * @access public
     * @var string
     */
    public $pattern;

    /**
     * Request method.
     *
     * @access public
     * @var string
     */
    public $method;

    /**
     * Request parameters.
     *
     * @access public
     * @var array
     */
    public $controller;

    /**
     * Request parameters.
     *
     * @access public
     * @var array
     */
    public $args;

    /**
     * Route constructor.
     *
     * @access public
     * @param string $name
     * @param array $controller
     * @param array $args
     */
    public function __construct(string $name, 
                                string $method, 
                                string $pattern, 
                                array $controller)
    {
        $this->name = $name;
        $this->method = $method;
        $this->pattern = $pattern;
        $this->controller = $controller;
    }

    /**
     * Route constructor.
     *
     * @access public
     * @param string $name
     * @param array $controller
     * @param array $args
     */
    public function test(string $uri, string $method): bool
    {
        if ($this->method == $method &&
            preg_match($this->pattern, $uri, $params_matches)) {
            array_shift($params_matches);
            $this->args = $params_matches;
            return true;
        }
        return false;
    }

    /**
     * Route constructor.
     *
     * @access public
     * @param string $name
     * @param array $controller
     * @param array $args
     */
    public function execute($request)
    {
        forward_static_call($this->controller, $request, ...$this->args);
    }

}
