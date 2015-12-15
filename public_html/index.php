<?php
use lib\Config;

defined('APP_DEFAULT_LOCALE') or define('APP_DEFAULT_LOCALE', 'ru');
defined('APP_WEB_ROOT_PATH') or define('APP_WEB_ROOT_PATH', __DIR__);
defined('ROOT_PATH') or define('ROOT_PATH', dirname(__DIR__));
defined('APP_ROOT_PATH') or define('APP_ROOT_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'app');

require(ROOT_PATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
require(APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');


$app = new \Slim\Slim(Config::$confArray['init']);

// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(Config::$confArray['production']);
});

//// Only invoked if mode is "development"
//$app->configureMode('development', function () use ($app) {
    //$app->config(\lib\Config::$confArray['development']);
//});

$view = $app->view();
$view->parserOptions = array(
    'debug' => true,
    'cache' => APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'cache',
);

new \lib\TwigExtension($app, array(
    'translations' => array('ru', 'en')
));

$revisionContent = @file_get_contents(__DIR__ . '/js/revision.js');
$revision = '';
if (!empty($revisionContent)) {
    preg_match('~APP_VERSION\s*=\s*(?<revision>[\d]+)~', $revisionContent, $matches);
    if (!empty($matches['revision'])) {
        $revision = $matches['revision'];
    }
}
$app->frontend_revision = $revision;

// Automatically load router files
$routers = glob(APP_ROOT_PATH . DIRECTORY_SEPARATOR . 'routers' . DIRECTORY_SEPARATOR . '*.router.php');
foreach ($routers as $router) {
    require $router;
}

$app->run();
