<?php

namespace Engine\Packages\RedBeanORM;

use RedBeanPHP\R;
use RedBeanPHP\Logger;
use Engine\Config;
use Error;

/**
 * RedBeanORM.php
 *
 * Class for database jobs via RedBeanORM.
 */
class RedBeanORMService
{

    /**
     * Alias for service.
     *
     * @access public
     * @var string
     */
    static public string $alias = 'database';

    /**
     * RedBeanORM service constructor.
     *
     * @access public
     */
    public function __construct()
    {
        $env = Config::get('env');

        R::setup("{$env['db_driver']}:host={$env['db_address']};dbname={$env['db_name']}",
                  $env['db_user'], $env['db_password']);

        if (!R::testConnection()) {
            throw new Error('Database connection was not established', 500, null);
        }

        R::freeze(true);
    }

    /**
     * RedBeanORM service destructor.
     *
     * @access public
     */
    public function __destruct()
    {
        R::close();
    }

    /**
     * Gives a facade of RedBean.
     *
     * @access public
     * @return class
     */
    public function r()
    {
        return R::class;
    }

    /**
     * Gives logs.
     *
     * @access public
     * @return Logger
     */
    public function logs(): Logger
    {
        return R::getDatabaseAdapter()
            ->getDatabase()
            ->getLogger();
    }

}
