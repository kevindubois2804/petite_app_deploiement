<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Dog;
use Doctrine\ORM\EntityManagerInterface;

class DogShowTest extends WebTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $client = static::createClient();
        $this->entityManager = $client->getContainer()->get('doctrine')->getManager();

        // Create a sample dog entity for the test
        $dog = new Dog();
        $dog->setName('TestDog');
        $dog->setImageUrl('https://example.com/image.jpg');
        $dog->setAge(3);
        $dog->setDescription('A very good dog.');

        $this->entityManager->persist($dog);
        $this->entityManager->flush();
    }

    public function testShowDogPage()
    {
        self::ensureKernelShutdown();
        $client = static::createClient();
        $client->request('GET', '/dog/TestDog');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'TestDog');
    }

    // protected function tearDown(): void
    // {
    //     parent::tearDown();

    //     // Remove the sample dog entity after the test
    //     $dog = $this->entityManager->getRepository(Dog::class)
    //         ->findOneBy(['name' => 'TestDog']);

    //     if ($dog) {
    //         $this->entityManager->remove($dog);
    //         $this->entityManager->flush();
    //     }

    //     $this->entityManager->close();
    //     $this->entityManager = null; // avoid memory leaks
    // }
}
