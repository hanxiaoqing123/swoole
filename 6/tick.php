<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/10
 * Time: 13:48
 */
$i=0;
//永久定时器
swoole_timer_tick(1000,function ($timeId,$params) use(&$i){
    $i++;
    echo "hello, {$params}---{$i}\n";
    if ($i>=5){
        //定时器的清除
        swoole_timer_clear($timeId);
    }
},'world');


