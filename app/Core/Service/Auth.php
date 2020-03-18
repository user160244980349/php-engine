<?php

namespace App\Core\Service;

use App\Core\ServiceBus;
use App\Model\User;

/**
 * Receiver.php
 *
 * Middleware class for parsing incoming request.
 */
class Auth
{

    /**
     * Register new user.
     *
     * @param array $user User credentials.
     * @access public.
     */
    public function register (array $user)
    {
        if ($user['user_password'] == $user['password_confirm']) {
            $user['user_password'] = md5(md5($user['user_password']));
            $user['password_confirm'] = md5(md5($user['password_confirm']));
            if (User::add($user)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Log user in.
     *
     * @param string $username.
     * @param steing $password.
     * @access public.
     */
    public function login (string $username, string $password)
    {
        $user = User::getByName($username);

        if ($user['user_password'] != md5(md5($password))) {
            return false;
        }
        ServiceBus::get('session')->set('user_id', $user['user_id']);
        return true;
    }

    /**
     * Get authorized user.
     *
     * @param int $user.
     * @access public.
     */
    public function user (int $id)
    {
        return User::getById($id);
    }

    /**
     * Check if user has permitions.
     *
     * @param array $permissions Permitions list.
     * @access public.
     */
    public function allowed (array $permissions)
    {
        $user_id = ServiceBus::get('session')->get('user_id');
        return isset($user_id);
    }

    /**
     * Log user out.
     *
     * @access public.
     */
    public function logout ()
    {
        ServiceBus::get('session')->destroy();
    }

}
