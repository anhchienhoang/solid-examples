<?php

namespace LKS\After;

interface CameraInterface
{
    public function getVersion();

    public function takePhoto();
}

class Camera1 implements CameraInterface
{
    public function getVersion()
    {
        return 1;
    }

    public function takePhoto()
    {
        echo 'Photo was taken with a lot of noise :('.PHP_EOL;
    }
}

class Camera2 implements CameraInterface
{
    public function getVersion()
    {
        return 2;
    }

    public function takePhoto()
    {
        echo 'Applied some filters'.PHP_EOL;
        echo 'Nice photo was taken :)'.PHP_EOL;
    }
}

abstract class Iphone
{
    protected $version;

    /** @var CameraInterface */
    protected $camera;

    public function __construct()
    {
        echo sprintf('I am version %d', $this->version).PHP_EOL;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    abstract public function setCamera(CameraInterface $camera);

    public function takePhoto()
    {
        $this->camera->takePhoto();
    }
}

class Iphone1 extends Iphone
{
    public function __construct()
    {
        $this->version = 1;
        parent::__construct();
    }

    public function setCamera(CameraInterface $camera)
    {
        if ($camera->getVersion() > 1) {
            throw new \Exception('The camera version is not supported.');
        }

        $this->camera = $camera;
    }
}

class Iphone2 extends Iphone
{
    public function __construct()
    {
        $this->version = 2;
        parent::__construct();
    }

    public function setCamera(CameraInterface $camera)
    {
        if ($camera->getVersion() < 2) {
            throw new \Exception('The camera version is not supported.');
        }

        $this->camera = $camera;
    }
}

$iphone1 = new Iphone1();
$iphone1->setCamera(new Camera1());
$iphone1->takePhoto();

$iphone1 = new Iphone2();
$iphone1->setCamera(new Camera2());
$iphone1->takePhoto();
