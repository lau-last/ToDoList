<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $response = $client->getResponse();

        if ($response->isRedirect()) {
            $client->followRedirect();
            $response = $client->getResponse();
        }
        
        $this->assertEquals(200, $response->getStatusCode());

    }
}
