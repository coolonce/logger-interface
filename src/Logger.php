<?php
/**
 * Created by PhpStorm.
 * User: swpi
 * Date: 17.07.19
 * Time: 15:10
 */

namespace Logger;
use GuzzleHttp\Client;

class Logger implements LoggerInterface
{

    protected $url = null;
    protected $port = null;

    public function __construct(string $url = null, string $port = null)
    {
        $this->url = $url;
        $this->port = $port;
    }

    public function Send(int $user_id = null, int $act_id = null, int $service_id = null, string $data = null, string $function_name = null) :bool
    {
        $client = new Client();
        $data = [
          'user_id' => $user_id,
          'act_id' => $act_id,
          'service_id' => $service_id,
          'data' => $data,
          'function_name' => $function_name,
        ];
        $data = json_encode($data);
        $requset = $client->requestAsync('POST', $this->url.$this->port, ['body'=>$data]);
    }

    public function SetUrl(string $url = null)
    {
        $this->url = $url;
    }

    public function SetPort(string $port = null)
    {
        $this->port = $port;
    }

    public function GetPort() : string
    {
        return $this->port;
    }

    public function GetUrl() : string
    {
        return $this->url;
    }

}