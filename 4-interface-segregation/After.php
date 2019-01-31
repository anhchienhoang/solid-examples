<?php
namespace ISP\After;

interface Animal
{
    public function walk();
}

interface FlyingAnimal extends Animal
{
    public function fly();
}

interface BarkingAnimal extends Animal
{
    public function bark();
}

class Dog implements BarkingAnimal
{
    public function __construct()
    {
        echo 'Hello, I am a Dog'.PHP_EOL;
    }

    public function walk()
    {
        echo 'I am walking'.PHP_EOL;
    }

    public function bark()
    {
        echo 'I am barking: Gow gow...'.PHP_EOL;
    }
}

class Bird implements FlyingAnimal
{
    public function __construct()
    {
        echo 'Hello, I am a Bird'.PHP_EOL;
    }

    public function walk()
    {
        echo 'I am walking'.PHP_EOL;
    }

    public function fly()
    {
        echo 'Yahooooo... I am flying on the sky...'.PHP_EOL;
    }

}

$dog = new Dog();
$dog->walk();
$dog->bark();

$bird = new Bird();
$bird->walk();
$bird->fly();
