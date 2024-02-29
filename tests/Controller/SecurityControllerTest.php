<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginAction()
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');
        $this->assertSelectorExists('input[name="_username"]');
        $this->assertSelectorExists('input[name="_password"]');
    }

    public function testLoginCheck()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/login_check', [
            '_username' => 'laurent',
            '_password' => '123',
        ]);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testLogoutCheck()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/logout');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
