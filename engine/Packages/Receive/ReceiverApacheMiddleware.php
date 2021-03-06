<?php

namespace Engine\Packages\Receive;

use Engine\Packages\Middleware\Bundled\IMiddleware;

/**
 * Receiver.php
 *
 * Middleware class for parsing incoming request.
 */
class ReceiverApacheMiddleware implements IMiddleware
{

    /**
     * Method providing middlewares chain call.
     *
     * @access public
     * @param Request $null - Null because not needed
     * @return Request - Initialized request object
     */
    public function let(?Request $request): Request
    {

        $parameters['uri'] = ltrim($_SERVER['REQUEST_URI'], '/');

        switch ($_SERVER['REQUEST_METHOD']) {

            case 'GET':
                $parameters = array_merge($parameters, $_GET);
                $parameters['method'] = 'get';
                break;

            case 'POST':
                $parameters = array_merge($parameters, $_POST);
                $parameters['uri'] = $_GET['uri'];
    
                if (isset($parameters['_method'])) {
                    $parameters['method'] = $parameters['_method'];
                } else {
                    $parameters['method'] = 'post';
                }
                break;

        }

        return new Request($parameters);
    }

}
