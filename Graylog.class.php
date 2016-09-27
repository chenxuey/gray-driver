<?php
/**
 * Created by PhpStorm.
 * User: chenxueyang
 * Date: 16/9/26
 * Time: 下午4:42
 */

namespace Think\Log\Driver;

class Graylog
{

    protected $config = array(
        'log_time_format' => ' c ',
        'log_file_size'   => 1073741824,
        'log_path'        => '',
    );

    // 实例化并传入参数
    public function __construct($config = array())
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * 日志写入接口
     * @access public
     * @param string $log 日志信息
     * @param string $destination  写入目标
     * @return void
     */
    public function write($log, $destination = '')
    {
        try {
            // 读取配置
            $logInfo = explode(':', C('LOG_GRAY_PATH'));
            $transport = new \Gelf\Transport\UdpTransport($logInfo[0], $logInfo[1], \Gelf\Transport\UdpTransport::CHUNK_SIZE_LAN);
            $publisher = new \Gelf\Publisher();
            $publisher->addTransport($transport);
            $message = new \Gelf\Message();
            $message->setShortMessage($log)
                ->setLevel(\Psr\Log\LogLevel::INFO)
                ->setAdditional('item', $_SERVER['HTTP_HOST']);
            $publisher->publish($message);
        } catch (\Exception $e) {
            return ;
        }
    }
}
