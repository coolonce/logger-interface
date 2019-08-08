<?php
/**
 * Created by PhpStorm.
 * User: swpi
 * Date: 17.07.19
 * Time: 15:12
 */

namespace Logger;


interface LoggerInterface
{
    public function Send(int $user_id = 0, int $act_id = 0, int $service_id = 0, string $data = '', string $function_name = '');

    public function SetUrl(string $url = null);

    public function SetPort(string $port = null);

    public function GetPort():string;

    public function GetUrl():string;

}