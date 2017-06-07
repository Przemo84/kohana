<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Transparent extension for the Kohana_Config_Database class
 *
 * @package    Kohana/Database
 * @category   Configuration
 * @author     Kohana Team
 * @copyright  (c) 2011 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Config_Database extends Kohana_Config_Database
{
}

return [
    'default' =>
        [
            'type' => 'PDO',
            'connection' =>
                [
                    'dsn' => 'mysql:dbname=kohana;host=mysql',
                    'username' => 'root',
                    'password' => 'root',
                    'persistent' => FALSE,
                ],

            'table_prefix' => '',
            'charset' => 'utf8',
            'profiling' => TRUE
        ]
];
