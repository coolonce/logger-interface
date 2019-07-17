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
    public function Send(int $user_id = null, int $act_id = null, int $service_id = null, string $data = null, string $function_name = null):bool;

    public function SetUrl(string $url = null);

    public function SetPort(string $port = null);

    public function GetPort():string;

    public function GetUrl():string;

}