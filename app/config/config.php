<?php
use lib\Config;
use Illuminate\Database\Capsule\Manager as Capsule;

defined('APP_DEBUG') or define('APP_DEBUG', true);
//defined('APP_DB_DEBUG') or define('APP_DB_DEBUG', false);

//function reconstructionPage() {
    //die(require APP_WEB_ROOT_PATH . DIRECTORY_SEPARATOR . 'index.php.temp');
//}

require 'db.php';

// Setup custom Twig view
$twigView = new \Slim\Views\Twig();

Config::$confArray = array(
    'init' => array(
        'debug'               => APP_DEBUG,
        'view'                => $twigView,
        'templates.path'      => APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates',
        'mode'                => 'production',
    ),
    'production' => array(
        'parameters' => array(
            'name'  => 'Evgeniy Blinov',
            'skype' => 'evgeniy_blinov',
            'email' => 'evgeniy_blinov@mail.ru',
        ),
        'auth' => array(
            'cookies.secret_key'  => '3c44d9aa3d78269adcc417ec67e03c26',
        ),
        'db' => array(
            'mysql' => array(
                'connect' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'dbname'   => APPLICATION_MYSQL_DB_NAME,
                    'user'     => APPLICATION_MYSQL_USER,
                    'password' => APPLICATION_MYSQL_PASS,
                    'charset'  => 'utf8'
                )
            ),
            'eloquent' => array(
                //'default' => array(
                    //'driver'    => 'mysql',
                    //'host'      => '127.0.0.1',
                    //'database'  => APPLICATION_MYSQL_DB_NAME,
                    //'username'  => APPLICATION_MYSQL_USER,
                    //'password'  => APPLICATION_MYSQL_PASS,
                    //'charset'   => 'utf8',
                    //'collation' => 'utf8_general_ci',
                    //'prefix'    => ''
                //),
                'default' => array(
                    'driver'    => 'postgresql',
                    'host'      => '127.0.0.1',
                    'port'      => '5432',
                    'database'  => APPLICATION_DATABASE_DB_NAME,
                    'username'  => APPLICATION_DATABASE_USER,
                    'password'  => APPLICATION_DATABASE_PASS,
                    'charset'   => 'utf8',
                    'collation' => 'utf8_general_ci',
                    'prefix'    => ''
                ),
            )
        )
    )
);

Config::$env = 'production';


/**
 * Configure the database and boot Eloquent
 */
$capsule = new Capsule;
$capsule->addConnection(Config::$confArray[Config::$env]['db']['eloquent']['default']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
date_default_timezone_set('Europe/Moscow');
