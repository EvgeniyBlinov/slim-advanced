<?php
switch ($_SERVER['SERVER_NAME']) {
    case 'blinovslim.blinov':
    case 'blinov.blinov':
        define('APPLICATION_MYSQL_DB_NAME', 'blinov_slim');
        define('APPLICATION_MYSQL_USER', 'root');
        define('APPLICATION_MYSQL_PASS', 'root');

        define('APPLICATION_DATABASE_DB_NAME', 'app');
        define('APPLICATION_DATABASE_USER', 'postgres');
        define('APPLICATION_DATABASE_PASS', 'postgres');
        break;
    default :
        define('APPLICATION_MYSQL_DB_NAME', 'blinov_slim');
        define('APPLICATION_MYSQL_USER', 'root');
        define('APPLICATION_MYSQL_PASS', 'root');
        break;
}
