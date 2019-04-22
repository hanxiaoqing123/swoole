<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/22
 * Time: 10:54
 */
//swoole的多进程模型：Master-Manager-Worker
$serv=new swoole_server('127.0.0.1',9501);
$serv->set([
    'worker_num'=>2,
    'task_worker_num'=>1
]);
$serv->on('Connect',function ($serv,$fd){

});
$serv->on('Receive',function ($serv,$fd,$fromId,$data){

});
$serv->on('Close',function ($serv,$fd){

});
$serv->on('Task',function ($serv,$taskId,$fromId,$data){

});
$serv->on('Finish',function ($serv,$taskId,$data){

});

/*
 * 区分Worker进程和Task进程:
 * 在各个进程启动和关闭的回调中去解决上面这个问题
 * 说明：1.onWorkerStart和onStart回调是在不同进程中并行执行的，不存在先后顺序。
 *      2.此处使用swoole_set_process_name方法修改进程名称，里面的参数server_process一定是该服务器端文件名，比如此处是server-process就无法运行
 * */
//Master进程
$serv->on('Start',function ($serv){
    //该回调中，仅允许echo、打印Log、修改进程名称，不得执行其他操作
    swoole_set_process_name('server_process:master');
});
//Manager进程
$serv->on('ManagerStart',function ($serv){
    swoole_set_process_name('server_process:manager');
});
//Worker进程:$worker_id是一个从[0-$worker_num)区间内的数字，表示这个Worker进程的ID
$serv->on('WorkerStart',function ($serv,$workerId){
    if ($workerId>=$serv->setting['worker_num']){
        swoole_set_process_name('server_process:task');
    }else{
        swoole_set_process_name('server_process:worker');
    }

});
$serv->start();