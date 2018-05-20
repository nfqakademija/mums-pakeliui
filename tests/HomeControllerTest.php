<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Goutte\Client;

class HomeControllerTest extends WebTestCase
{

    public function testHomePageSubmitSearchFormButton()
    {
        $client = static::createClient();
        $crawler1 = $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler1->filter('.search-form')->count());
        $form = $crawler1->selectButton('trip_search_filter')->form();
        $client->submit($form, array('trip_search[travelerType]' => '0'));


        $redirectPage = $client->getCrawler();
        echo $redirectPage->getUri();
        $this->assertSame(1, $redirectPage->filter('html:contains("Filtruoti")')->count());

    }

}
