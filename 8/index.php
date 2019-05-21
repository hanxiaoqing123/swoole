<?php

require_once __DIR__ . "/Mailer.php";
require_once __DIR__ . "/TaskClient.php";

$data = [
    'event' => TaskClient::EVENT_TYPE_SEND_MAIL,
    'to' => '1009833975@qq.com',
    'subject' => 'just a test',
    'content' => 'This is just a test.',
];
//$mailer = new Mailer;
//$mailer->send($data);
$client = new TaskClient();
$client->sendData($data);