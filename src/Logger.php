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
    protected $type = null;

    protected $TYPELOGGERS = [
        'clickhouse' => 'clickhouse',
        'file' => 'file',
        'mixed' => 'mixed'
    ];


    public function __construct(string $url = null, string $port = null, string $type = 'clickhouse')
    {
        $this->url = $url;
        $this->port = $port;
        $this->type = $type;
    }

    public function Send(int $user_id = null, int $act_id = null, int $service_id = null, string $data = null, string $function_name = null)
    {
        $data = [
            'user_id' => $user_id,
            'act_id' => $act_id,
            'service_id' => $service_id,
            'data' => $data,
            'function_name' => $function_name,
        ];

        $name = $this->TYPELOGGERS[$this->type];
       try{
           $this->$name($data);
       }catch(\Exception $e){}
    }


    public function clickhouse(array $data = []){
        $client = new Client();
        $data = json_encode($data);
        $client->request('POST', $this->url.':'.$this->port, ['body'=>$data]);
    }

    public function file(array $data = []){
        file_put_contents(__DIR__.'/logLogger.txt', var_export(json_encode($data).'\r\n',1), FILE_APPEND);
    }

    public function mixed(array $data = [])
    {
        $this->clickhouse($data);
        $this->file($data);
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