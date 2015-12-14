<?php
namespace lib;

use lib\Config;
use PDO;

class Core 
{
    public $dbh; // handle of the db connexion
    private static $instance;

    /**
     * @return Core
     */
    public static function getInstance() 
    {
        if (!isset(self::$instance)) {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct() 
    {
        $dbConfig = Config::readFromAlias('db');
        if (!$dbConfig) {
            throw new \Exception('DB config not found!');
        }

        $dsnParams = array_intersect_key(
            $dbConfig['mysql']['connect'],
            array_flip($this->getDSNAvailableParams())
        );

        $dsn = sprintf('mysql:%s', http_build_query($dsnParams, null, ';'));
        try {
            $this->dbh = new PDO($dsn, $dbConfig['mysql']['connect']['user'], $dbConfig['mysql']['connect']['password']);
        } catch (\Exception $e) {
            reconstructionPage();
        }
    }

    /**
     * @return array of DSN available params
     */
    public function getDSNAvailableParams()
    {
        return array(
            'host',
            'port',
            'dbname',
            'unix_socket',
            'charset',
        );
    }
}
