<?php
/**
 * Created by PhpStorm.
 * User: swpi
 * Date: 21.07.19
 * Time: 14:12
 */

return [
    'type' => env('LOG_CHANNEL', 'clickhouse'),
    'url' => env('LOG_URL', '127.0.0.1'),
    'port' => env('LOG_PORT', '81'),
    'path' => env('LOG_PATH', storage_path().'/log.txt')
];