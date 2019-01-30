<?php
namespace OC\After;

interface LoggerInterface
{
    public function log(array $data);
}

class FileLogger implements LoggerInterface
{
    public function log(array $data)
    {
        echo 'Logged into the file name.log'.PHP_EOL;
    }
}

class DbLogger implements LoggerInterface
{
    public function log(array $data)
    {
        echo 'Logged into the db'.PHP_EOL;
    }
}

class KibanaLogger implements LoggerInterface
{
    public function log(array $data)
    {
        echo 'Logs was sent to Kibana'.PHP_EOL;
    }
}

class UserService
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function createUser()
    {
        echo 'User was created.'.PHP_EOL;
        $this->logger->log(['test' => 'logger']);
    }
}

$logger = new FileLogger();
$userService = new UserService($logger);
$userService->createUser();
