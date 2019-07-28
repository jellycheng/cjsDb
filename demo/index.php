<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2019/7/28
 * Time: 19:19
 */
require_once __DIR__ . '/common.php';

echo \CjsDb\getDbPath() . PHP_EOL;


var_dump(class_exists('DB'));
echo PHP_EOL;
\CjsDb\initDbalias();
var_dump(class_exists('DB'));
echo DB::VERSION . PHP_EOL;
