<?php
/**
 * Created by PhpStorm.
 * User: hxq
 * Date: 2019/6/2
 * Time: 22:53
 */
//echo 678;
$http = new swoole_http_server("127.0.0.1", 30000);
$http->on('request', function (swoole_http_request $request, swoole_http_response $response) {
    print_r($request);
    $response->status(200);
    $response->end('hello world 888.');
});
$http->start();