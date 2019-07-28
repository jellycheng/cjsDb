<?php
namespace CjsDb;


function getDbPath() {
    return __DIR__ . '/';
}

function initDbalias() {
    static $isInit;
    if($isInit) {
        return '';
    }
    $isInit = true;
    class_alias('\\CjsDb\\DB', 'DB');
}

function writeLog($msg) {

}


