<?php

use Engine\Decorators\Debug;
use Engine\Decorators\MiddlewaresQueue;
use Engine\View;

# Call application
try {
    MiddlewaresQueue::run();
} catch (Error $exception) {
    Debug::push($exception);
    $view = new View('exception.php', ["exception" => $exception]);
    $view->display();
}

Debug::printIfAllowed();