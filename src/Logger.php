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

    protected $settings;

    protected $TYPELOGGERS = [
        'clickhouse' => 'clickhouse',
        'file' => 'file',
        'mixed' => 'mixed'
    ];


    public function __construct(string $url = null, string $port = null, string $type = 'clickhouse')
    {
        $this->settings = config('logger');

        $this->url = $url === null ? $this->settings['url'] : $url;
        $this->port = $port === null ? $this->settings['port'] : $port;
        $this->type = $this->settings['type'] != null ? $this->settings['type'] : $type;
    }

    public function Send(int $user_id = 0, int $act_id = 0, int $service_id = 0, string $data = '', string $function_name = '')
    {
        $data = [
            'user_id' => $user_id,
            'act_id' => $act_id,
            'service_id' => $service_id,
            'data' => $data,
            'function_name' => $function_name,
        ];

        $name = $this->TYPELOGGERS[$this->type];
        try {
            $this->$name($data);
        } catch (\Exception $e) {
        }
    }


    public function clickhouse(array $data = [])
    {
        $client = new Client();
        $data = json_encode($data);
        $client->request('POST', $this->url . ':' . $this->port, ['body' => $data]);
    }

    public function file(array $data = [])
    {
        file_put_contents(__DIR__ . '/logLogger.txt', var_export(json_encode($data) . '\r\n', 1), FILE_APPEND);
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