<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/10
 * Time: 15:44
 */
$client= new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_SYNC);
// 随后建立连接，连接失败直接退出并打印错误码
$client->connect('127.0.0.1',9501) || exit("connect failed. Error: {$client->errCode}\n");
//向服务端发送数据
$client->send("Just a test.");
$client->close();