<?php
namespace LKS\Before;

class Camera1
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

class Camera2
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

class Iphone1
{
    protected $version = 1;

    public function __construct()
    {
        echo 'I am version 1'.PHP_EOL;
    }

    /**
     * @var Camera1
     */
    protected $camera;

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setCamera(Camera1 $camera)
    {
        $this->camera = $camera;
    }

    public function takePhoto()
    {
        $this->camera->takePhoto();
    }
}

class Iphone2
{
    protected $version = 2;

    public function __construct()
    {
        echo 'I am version 2'.PHP_EOL;
    }

    /**
     * @var Camera2
     */
    protected $camera;

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setCamera(Camera2 $camera)
    {
        $this->camera = $camera;
    }

    public function takePhoto()
    {
        $this->camera->takePhoto();
    }
}

$iphone1 = new Iphone1();
$iphone1->setCamera(new Camera1());
$iphone1->takePhoto();

$iphone1 = new Iphone2();
$iphone1->setCamera(new Camera2());
$iphone1->takePhoto();
