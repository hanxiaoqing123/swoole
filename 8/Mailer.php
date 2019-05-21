<?php

require_once __DIR__ . '/vendor/autoload.php';

class Mailer
{
    public $transport;
    public $mailer;

    /**
     * 发送邮件类 参数 $data 需要三个必填项 包括 邮件主题`$data['subject']`、接收邮件的人`$data['to']`和邮件内容 `$data['content']`
     * @param Array $data
     * @return bool $result 发送成功 or 失败
     */
    public function send($data)
    {
        $this->transport = (new Swift_SmtpTransport('smtp.qq.com', 465, 'ssl'))  // 如果是163邮箱，host改为smtp.163.com
            ->setEncryption('ssl')
            ->setUsername('1695722217@qq.com')
            ->setPassword('wswwnwukppwaeaje');
            // 如果是qq邮箱，这里要填写第三方授权码，而不是你的qq登录密码，参考qq邮箱的帮助文档
            //http://service.mail.qq.com/cgi-bin/help?subtype=1&&id=28&&no=1001256

        $this->mailer = new Swift_Mailer($this->transport);

        $message = (new Swift_Message($data['subject']))
            ->setFrom(array('1695722217@qq.com' => '欢乐豆'))
            ->setTo(array($data['to']))
            ->setBody($data['content']);

        $result = $this->mailer->send($message);
        // 释放
        $this->destroy();

        return $result;
    }

    public function destroy()
    {
        $this->transport = null;
        $this->mailer = null;
    }
}