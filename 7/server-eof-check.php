<?php
/**
 * Created by PhpStorm.
 * User: hxq
 * Date: 2019/5/20
 * Time: 10:47
 */
class ServerEofCheck{
    private  $_serv;


    /*
     * init
     * */
    public function __construct()
    {

        $this->_serv=new swoole_server('127.0.0.1',9501);
        $this->_serv->set([
            'worker_num'=>1,
            'open_eof_check'=>true, //打开EOF检测
            'package_eof'=>"\r\n",  //设置EOF
            'open_eof_split'=>true,  //自动分包与自行拆包效果一样，性能较差
        ]);
        $this->_serv->on('Receive',[$this,'onReceive']);
    }

    public function onReceive($serv,$fd,$fromId,$data)
    {
        echo "Server received data:{$data}".PHP_EOL;
        //server的效果可能会一次性收到多个完整的包，因此还需要在回调内对收到的数据作拆分处理
//        $datas=explode("\r\n",$data);
//        foreach ($datas as $data){
//            if (!$data){
//                continue;
//            }
//            echo "Server received data:{$data}".PHP_EOL;
//        }

    }

    /*
     * start server
     * */
    public function start()
    {
        $this->_serv->start();

    }
}
$reload =new ServerEofCheck();
$reload->start();