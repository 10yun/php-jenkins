<?php

namespace shiyunJK\Supports;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class Log
 *
 * @package shiyunJK\Supports
 */
class Log
{
    /**
     */
    protected array static $config = [
        'level'      => 'debug',
        'permission' => 0777,
        'file'       => '/tmp/jenkins-php.log',
    ];

    /**
     * 获取Logger
     *
     * @param array $config
     * @return \Monolog\Logger
     */
    public static function getLogger($config = [])
    {
        $config = array_merge(self::$config, $config);
        $handle[] = new StreamHandler($config['file'], Logger::DEBUG);
        $logger = new Logger('jenkins-php', $handle);

        return $logger;
    }
}
