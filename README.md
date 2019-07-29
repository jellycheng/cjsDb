# cjsDb
```
db,laravel database
```


### composer require
```
"illuminate/database": "5.5.*",
"illuminate/events": "5.5.*",
```

### init
```
$manager = \CjsDb\Database::getInstance()->setDbconfig(include __DIR__ . '/config/db.php')->init();
$manager->listen(function($execObj){
    Log::info(sprintf('sql:%s bindings:%s dbname:%s time:%s', $execObj->sql, var_export($execObj->bindings, true), $execObj->connectionName, $execObj->time));
});
```
