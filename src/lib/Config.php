<?php
namespace lib;

class Config
{
    static $env = 'production';
    static $confArray;

    /**
     * @return mixed of config param by name
     */
    public static function read($name) {
        return self::$confArray[$name];
    }

    /**
     * Write config param by name
     * 
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public static function write($name, $value) {
        self::$confArray[$name] = $value;
    }

    /**
     * @return mixed of config param by alias
     */
    public static function readFromAlias($alias)
    {
        $aliasParams = explode('.', $alias);

        $result = self::$confArray[self::$env];
        foreach ($aliasParams as $aliasParam) {
            if (isset($result[$aliasParam])) {
                $result = $result[$aliasParam];
            } else {
                return null;
            }
        }

        return $result;
    }
}
