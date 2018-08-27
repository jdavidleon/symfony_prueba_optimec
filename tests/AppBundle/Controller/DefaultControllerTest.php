<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $link = $crawler->filter('a:contains(Página principal)')->link();
        $crawler = $client->click($link);

        $this->assertGreaterThan(
        	0,
        	$crawler->filter('h1:contains(Aplicativo de Productos)')->count()
        );	
    }
}
