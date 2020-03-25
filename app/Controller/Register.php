<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\View;
use App\Core\ServiceBus;

/**
 * Register.php
 *
 * Controller class to manage registration.
 */
class Register
{

    /**
     * Go to register page.
     *
     * @param Request $request.
     * @access public.
     */
    public static function toRegisterPage (Request $request)
    {
        if (ServiceBus::get('session')->get('user_id')) {
            header("location: /home");
        }

        $request->view = new View('register.tpl', [
            'title' => 'Register',
        ]);
    }

    /**
     * Register new user.
     *
     * @param Request $request.
     * @access public.
     */
    public static function register (Request $request)
    {
        $auth = ServiceBus::get('auth');

        if ($auth->register([
            'user_name' => $request->parameters['username'],
            'user_password' => $request->parameters['password'],
            'password_confirm' => $request->parameters['password_confirm'],
            'user_email' => $request->parameters['email'] ])) {

            if ($auth->login(   $request->parameters['username'],
                                $request->parameters['password'] )) {
                header("location: /home");
                exit;
            }
        }

        header("location: /register");
        exit;
    }

}