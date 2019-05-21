<?php

require_once __DIR__ . "/Mailer.php";
require_once __DIR__ . "/TaskClient.php";

$data = [
    'event' => TaskClient::EVENT_TYPE_SEND_MAIL,
    'to' => '569529989@qq.com',
    'subject' => '邮件主题hxq',
    'content' => '邮件内容hello 王小豆.',
];
//$mailer = new Mailer;
//$mailer->send($data);
$client = new TaskClient();
$client->sendData($data);