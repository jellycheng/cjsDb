<?php namespace CjsDb\Handlers;
use Illuminate\Contracts\Debug\ExceptionHandler;
use  CjsDb\Exceptions\DbException;
use Exception;
//use Log;

/**
 * 数据库异常处理类
 */
class DbExceptionHandler implements ExceptionHandler
{
    /**
     * Report or log an exception.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e) {
        //Log::error(__METHOD__, ['ExceptionCode'=>$e->getCode(), 'ExceptionMessage'=>$e->getMessage()]);
        throw new DbException(__METHOD__ . " db异常：".$e->getMessage(), $e->getCode());
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $e){
        //Log::error(__METHOD__, ['ExceptionCode'=>$e->getCode(), 'ExceptionMessage'=>$e->getMessage()]);
        throw new DbException(__METHOD__ . " db异常：".$e->getMessage(), $e->getCode());
    }

    /**
     * Render an exception to the console.
     *
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @param  \Exception  $e
     * @return void
     */
    public function renderForConsole($output, Exception $e){
        //Log::error(__METHOD__, ['ExceptionCode'=>$e->getCode(), 'ExceptionMessage'=>$e->getMessage()]);
        throw new DbException(__METHOD__ . " db异常：".$e->getMessage(), $e->getCode());
    }
}
