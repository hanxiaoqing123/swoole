<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/23
 * Time: 15:41
 */
//常驻内存以及避免内存如何泄露
$serv=new swoole_server('127.0.0.1',9501);
/*
 * max_request参数对server有下面几种限制条件
 * 1.max_request只能用于同步阻塞、无状态的请求响应式服务器程序
 * 2.纯异步的Server不应当设置max_request
 * 3.使用Base模式时max_request是无效的
 * */
$serv->set([
    'worker_num'=>1,
    'task_worker_num'=>1,
    'max_request'=>3,       //worker进程的最大任务数
    'task_max_request'=>4,  //task进程的最大任务数
]);
$serv->on('Connect',function ($serv,$fd){

});
$serv->on('Receive',function ($serv,$fd,$fromId,$data){
    $serv->task($data);

});
$serv->on('Task',function ($serv,$taskId,$fromId,$data){

});
$serv->on('Finish',function ($serv,$taskId,$data){

});
$serv->on('Close',function ($serv,$fd){

});
$serv->start();
