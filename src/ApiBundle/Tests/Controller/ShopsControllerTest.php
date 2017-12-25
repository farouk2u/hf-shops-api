<?php

namespace ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShopsControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'shops');
    }

    public function testLike()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'shops/{id}/like');
    }

    public function testUnlike()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'shops/{id}/unlike');
    }

    public function testDislike()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'shops/{id}/dislike');
    }

}
