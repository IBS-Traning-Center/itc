<?php

namespace Luxoft\Dev\Agents;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerTrait;

class LmsAgent implements Log\LoggerAwareInterface
{
    use LoggerTrait;
    protected $client;

    public function init() {

    }

    protected function connection() {
        $userName = "luxoft";
        $userPassword = "KmUny6gB";
        $server = 'ftp.luxoft.csod.com';

        $sftp = new Net_SFTP($ftp_server);
    }
}