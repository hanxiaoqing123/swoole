<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/6
 * Time: 11:39
 */
require_once("Test.php");

class NoReload{
    private $_serv;
    private $_test;

    public function __construct()
    {
        $this->_serv=new swoole_server('127.0.0.1',9501);
        $this->_serv->set([
           'worker_num'=>1
        ]);
        $this->_serv->on('Receive',[$this,'onReceive']);
        $this->_test=new Test();
    }

    public function start()
    {
        $this->_serv->start();
        
    }

    public function onReceive($serv,$fd,$fromId,$data)
    {
        $this->_test->run($data);
    }

}

$noReload=new NoReload();
$noReload->start();