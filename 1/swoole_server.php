<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/12
 * Time: 11:17
 */
//TCP异步多线程服务器
$serv=new swoole_server('127.0.0.1',9501);
//配置项
$serv->set([
    'worker_num'=>2
]);
/*
 * 新的客户端连接
 * @param $serv $serv是我们一开始创建的swoole_server对象
 * @param $fd   唯一标识，用于区分不同的客户端，同时该参数是1-1600万之间可以复用的整数
 * */
$serv->on('Connect',function ($serv,$fd){
    echo 'new client connected .'.PHP_EOL;
});
/*
 * server接收到客户端的数据后，worker进程内触发该回调
 * @param $serv $serv是我们一开始创建的swoole_server对象
 * @param $fd   唯一标识，用于区分不同的客户端，同时该参数是1-1600万之间可以复用的整数
 * @param $fromId 指的是哪一个reactor线程
 * @param $data 就是服务端接受到的数据，是字符串或者二进制内容
 * */
$serv->on('Receive',function ($serv,$fd,$fromId,$data){
    // 收到数据后发送给客户端
    $serv->send($fd,'Server '.$data."fromId==>".$fromId);
});

/*
 * 客户端断开连接或者server主动关闭连接时 worker进程内调用
 * @param $serv $serv是我们一开始创建的swoole_server对象
 * @param $fd   唯一标识，用于区分不同的客户端，同时该参数是1-1600万之间可以复用的整数
 * */
$serv->on('Close',function ($serv,$fd){
    echo  "Client close.".PHP_EOL;
});

//启动server
$serv->start();