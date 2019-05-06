<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/6
 * Time: 11:37
 */
class Test
{
    public function run($data)
    {
        // echo $data;

        $data = json_decode($data, true);
        if (!is_array($data)) {
            echo "server receive \$data format error666.\n";
            return ;
        }
        var_dump($data);
    }
}