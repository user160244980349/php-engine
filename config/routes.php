<?php

/**
 * Patterns for parameters:
 *
 * ([0-9]+)      <- number
 * ([a-zA-Z]+)   <- word
 */

return [

    ['name' => 'welcome.get',
        'method' => 'get',
        'pattern' => '/^$/',
        'controller' => ['App\Controllers\Welcome', 'toWelcomePage']],

    ['name' => 'register.get',
        'method' => 'get',
        'pattern' => '/^register$/',
        'controller' => ['App\Controllers\Register', 'toRegisterPage']],

    ['name' => 'register.post',
        'method' => 'post',
        'pattern' => '/^register$/',
        'controller' => ['App\Controllers\Register', 'register']],

    ['name' => 'login.get',
        'method' => 'get',
        'pattern' => '/^login$/',
        'controller' => ['App\Controllers\Login', 'toLoginPage']],

    ['name' => 'login.post',
        'method' => 'post',
        'pattern' => '/^login$/',
        'controller' => ['App\Controllers\Login', 'login']],

    ['name' => 'home.get',
        'method' => 'get',
        'pattern' => '/^home$/',
        'controller' => ['App\Controllers\Home', 'toHomePage']],

    ['name' => 'logout.post',
        'method' => 'post',
        'pattern' => '/^logout$/',
        'controller' => ['App\Controllers\Login', 'logout']],

];
