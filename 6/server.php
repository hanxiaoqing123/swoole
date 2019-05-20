<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/10
 * Time: 14:38
 */
$serv=new swoole_server('127.0.0.1',9501);
$serv->set([
    'worker_num'=>2
]);
$serv->on('Connect',function ($serv,$fd){
    echo 'new client connected .'.PHP_EOL;
});
//onReceive回调函数必须存在
$serv->on('Receive',function ($serv,$fd,$fromId,$data){
    // 收到数据后发送给客户端
    swoole_timer_after(3000, function () {
        echo "only once.\n";
    });
//    $serv->after(3000,function (){
//        echo "only once.\n";
//    });
});
//回调函数:onWorkerStart
$serv->on('WorkerStart',function ($serv,$workerId){
    if ($workerId==0){
        $i=0;
        $params="world";
        $serv->tick(1000,function ($timeId) use($serv,&$i,$params){
            $i++;
            echo "hello, {$params}---{$i}\n";
            if ($i>=5){
                $serv->clearTimer($timeId);
            }
        });
}
});
$serv->start();