<?php

namespace App\Tests\Entity;

use App\Entity\Dog;
use PHPUnit\Framework\TestCase;

class DogTest extends TestCase
{
    public function testDogEntity()
    {
        $dog = new Dog();
        $dog->setName('Max');
        $dog->setAge(6);

        $this->assertSame('Max', $dog->getName());
        $this->assertSame(6, $dog->getAge());
    }
}
