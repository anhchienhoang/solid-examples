<?php

namespace ISP\Before;

interface Animal
{
    public function walk();

    public function fly();

    public function bark();
}

class Dog implements Animal
{
    public function __construct()
    {
        echo 'Hello, I am a Dog'.PHP_EOL;
    }

    public function walk()
    {
        echo 'I am walking'.PHP_EOL;
    }

    public function fly()
    {
        // Oooopps how can I?
        return null;
    }

    public function bark()
    {
        echo 'I am barking: Gow gow...'.PHP_EOL;
    }
}

class Bird implements Animal
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

    public function bark()
    {
        // No, I'm not a dog
        return null;
    }
}

$dog = new Dog();
$dog->walk();
$dog->fly();
$dog->bark();

$bird = new Bird();
$bird->walk();
$bird->fly();
$bird->bark();
