<?php
namespace DI\Before;

class FileLogger
{
    public function log(array $data)
    {
        echo 'Store data into the file /tmp/name.log';
    }
}

class UserService
{
    private $logger;

    public function __construct(FileLogger $logger)
    {
        $this->logger = $logger;
    }

    public function createUser()
    {
        $this->logger->log(['test' => 'logger']);
    }
}

$logger = new FileLogger();
$userService = new UserService($logger);
$userService->createUser();
