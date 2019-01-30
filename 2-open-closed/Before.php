<?php

namespace OC\Before;

class Logger
{
    protected $config;

    public function __construct(string $config = null)
    {
        if (null !== $config) {
            $this->config = $config;
        }
    }

    public function log(array $data)
    {
        switch ($this->config) {
            case 'db':
                $this->logDb($data);
                break;
            default:
                $this->logFile($data);
        }
    }

    private function logDb(array $data)
    {
        echo 'Logged into the db'.PHP_EOL;
    }

    private function logFile(array $data)
    {
        echo 'Logged into the file name.log'.PHP_EOL;
    }
}

class UserService
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function createUser()
    {
        echo 'User was created.'.PHP_EOL;
        $this->logger->log(['test' => 'logger']);
    }
}

$logger = new Logger('db');
$userService = new UserService($logger);
$userService->createUser();
