<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2019/7/28
 * Time: 18:21
 */

namespace CjsDb;

use \CjsDb\Handlers\DbExceptionHandler;
class Database
{
    protected $isInit = false; //是否初始化
    protected $manager;  //db manager
    protected $dbConfig = []; //db配置
    protected $container; //容器对象
    protected function __construct()
    {
    }

    public static function getInstance() {
        static $instance;
        if(!$instance) {
            $instance = new static();
        }
        return $instance;
    }

    public function setDbconfig($config) {
        $this->dbConfig = $config;
        return $this;
    }

    public function init() {
        if($this->isInit) {
            return $this;
        }
        $capsule = new \Illuminate\Database\Capsule\Manager();
        $this->container = $capsule->getContainer(); //获取容器对象
        //$capsule->getContainer() 返回 Illuminate\Container\Container 容器类对象
        //注入Debug ExceptionHandler
        $this->container->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            DbExceptionHandler::class
        );
        //返回Illuminate\Database\DatabaseManager类对象
        $manager = $capsule->getDatabaseManager();
        //添加连接配置
        foreach ($this->dbConfig as $key => $val) {
            $capsule->addConnection($val, $key);
        }
        $capsule->setEventDispatcher($this->getEventObj());
        $capsule->bootEloquent();
        $capsule->setAsGlobal();
        $this->manager = $manager;

        $this->isInit = true;
        return $this;
    }

    public function getEventObj() {
        static $event;
        if(!$event) {
            //$event = new \Illuminate\Events\Dispatcher();
            //或者
            $event = new \Illuminate\Events\Dispatcher($this->container);
        }
        return $event;
    }


    public function getManager() {
        return $this->manager;
    }


    public function listen() {
        $this->getEventObj()->listen('Illuminate\\Database\\Events\\QueryExecuted', function ($queryObj) {
            $msg = sprintf('sql:%s bindings:%s dbname:%s time:%s',
                            $queryObj->sql,
                            var_export($queryObj->bindings, true),
                            $queryObj->connectionName,
                            $queryObj->time);

            \CjsDb\writeLog($msg);
        });
    }


}