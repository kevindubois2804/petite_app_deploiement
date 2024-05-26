<?php

namespace App\Tests\Regression;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserCreationTest extends WebTestCase
{
    public function testUserCreation()
    {
        $client = static::createClient();
        $client->request('GET', '/register');

        $client->submitForm('Register', [
            'registration_form[email]' => 'testuser@example.com',
            'registration_form[password]' => 'password123',
        ]);

        $this->assertResponseRedirects('/login');
        $client->followRedirect();
    }
}
