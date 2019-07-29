<?php
namespace CjsDb\Exceptions;
/**
 *  数据库异常
 */

use Exception;
class DbException extends Exception
{
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }

}