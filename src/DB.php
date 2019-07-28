<?php
namespace CjsDb;


class DB
{
    public static function getFacadeRoot()
    {
        return Database::getInstance()->getManager();
    }

    public static function __callStatic($method, $args)
    {
        //其实就是 Illuminate\Database\DatabaseManager 类对象
        $instance = static::getFacadeRoot();

        switch (count($args)) {
            case 0:
                return $instance->$method();
            case 1:
                return $instance->$method($args[0]);
            case 2:
                return $instance->$method($args[0], $args[1]);
            case 3:
                return $instance->$method($args[0], $args[1], $args[2]);
            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]);
            default:
                return call_user_func_array(array($instance, $method), $args);
        }
    }

}