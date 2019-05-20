<?php
/**
 * Created by PhpStorm.
 * User: hxq
 * Date: 2019/5/20
 * Time: 10:51
 */
$client=new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_SYNC);
$client->connect('127.0.0.1',9501) || exit("connect failed. Error: {$client->errCode}\n");
//向服务器端发送数据
for($i=0;$i<3;$i++){
    $client->send("Just a test.\r\n");
}
$client->close();