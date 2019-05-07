<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/6
 * Time: 17:06
 */
class Reload
{
    private $_serv;
    private $_test;
    /**
     * init
     */
    public function __construct()
    {
        $this->_serv = new Swoole\Server("127.0.0.1", 9501);
        $this->_serv->set([
            'worker_num' => 1,
             //启用守护进程后，server内所有的标准输出都会被丢弃
            'daemonize' => true,
             //swoole在运行时就会把所有的标准输出统统记载到该文件内
            'log_file' => __DIR__ . '/server.log',
        ]);
        $this->_serv->on('Receive', [$this, 'onReceive']);
        $this->_serv->on('WorkerStart', [$this, 'onWorkerStart']);
    }
    /**
     * start server
     */
    public function start()
    {
        $this->_serv->start();
    }
    public function onWorkerStart($serv, $workerId)
    {
        //PHP开启了APC/OpCache，reload重载入时会受到影响，可以通过调用opcache_reset刷新OpCode缓存来解决
        opcache_reset();
        require_once("Test.php");
        $this->_test = new Test;

    }
    public function onReceive($serv, $fd, $fromId, $data)
    {
        $this->_test->run($data);
    }
}
$reload = new Reload;
$reload->start();