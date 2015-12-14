<?php
use lib\Config;

defined('APP_DEBUG') or define('APP_DEBUG', false);
//defined('APP_DB_DEBUG') or define('APP_DB_DEBUG', false);

function reconstructionPage() {
    die(require APP_WEB_ROOT_PATH . DIRECTORY_SEPARATOR . 'index.php.temp');
}

require 'db.php';

// Setup custom Twig view
$twigView = new \Slim\Views\Twig();

Config::$confArray = array(
    'init' => array(
        'debug'               => APP_DEBUG,
        'view'                => $twigView,
        'templates.path'      => APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR,
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
                    'charset' => 'utf8'
                )
            )
        )
    )
);

Config::$env = 'production';
