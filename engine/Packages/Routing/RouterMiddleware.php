<?php
namespace Engine\Packages\Routing;

use Engine\Packages\Middleware\Bundled\IMiddleware;
use Engine\Config;
use Engine\Packages\Receive\Request;
use Error;

/**
 * Router.php
 *
 * Simple router class for managing urls.
 */
class RouterMiddleware implements IMiddleware
{
    /**
     * Map for url's and controllers.
     *
     * @access private
     * @var array
     */
    private $_routes;

    /**
     * ServiceBus services registration.
     *
     * @access public
     * @return ServiceBus
     */
    public function __construct()
    {
        $this->_routes = Config::get('routes');
    }

    /**
     * Method providing middlewares chain call.
     *
     * @access public
     * @param Request $request
     * @return Request
     * @throws Error
     */
    public function let(Request $request): Request
    {
        foreach ($this->_routes as $route) {
            if ($route->test($request->parameters['uri'],
                             $request->parameters['method'])) {
                
                $request->route = $route;
                return $request;
            }
        }
        
        throw new Error('The requested route does not exist!', 404);
    }

}