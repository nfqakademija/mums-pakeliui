<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testSearchForm()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $form = $crawler->filter('.form-wrap ')->selectButton("Ieškoti")->form();
        $form['trip_search[travelerType]'] = '0';
        $form['trip_search[departFrom]'] = 'Vilnius';

        $client->followRedirects(true);
        $client->submit($form);
        $this->assertContains("trip_search[departDate]", $client->getResponse()->getContent());
        $this->assertContains("trip_search[timeFrom]", $client->getResponse()->getContent());
        $this->assertContains("trip_search[timeTo]", $client->getResponse()->getContent());
        $this->assertContains("trip_search[smoke]", $client->getResponse()->getContent());
        $this->assertContains("trip_search[pets]", $client->getResponse()->getContent());
    }
}
