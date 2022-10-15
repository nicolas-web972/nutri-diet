<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{
    public function testHomePage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $link = $crawler->selectLink("Inscription");
        $this->assertEquals(2, count($link));

        $card = $crawler->filter('.recipes .card');
        $this->assertEquals(3, count($card));

        $this->assertSelectorTextContains('h1', 'Bienvenue sur nutridiet');
    }
}
