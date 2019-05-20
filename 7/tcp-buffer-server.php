<?php
/**
 * Created by PhpStorm.
 * User: hxq
 * Date: 2019/5/17
 * Time: 17:54
 */
class TcpBufferServer{
    private  $_serv;


    /*
     * init
     * */
    public function __construct()
    {

        $this->_serv=new swoole_server('127.0.0.1',9501);
        $this->_serv->set([
          'worker_num'=>1
        ]);
        $this->_serv->on('Receive',[$this,'onReceive']);
    }

    public function onReceive($serv,$fd,$fromId,$data)
    {
        echo "Server received data:{$data}".PHP_EOL;

    }

    /*
     * start server
     * */
    public function start()
    {
        $this->_serv->start();

    }
}
$reload =new TcpBufferServer();
$reload->start();