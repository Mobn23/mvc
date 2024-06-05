<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardControllerJsonTest extends WebTestCase
{
    public function testDeleteSession()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/session/delete');

        $this->assertResponseRedirects('/session/display');
        $client->followRedirect();
        $this->assertSelectorTextContains('.flash-notice', 'Nu är sessionen raderad!');
    }

    public function testApiDeck()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/deck');

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('cardsSuits', $data);
    }

    public function testApiDeckShuffle()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/deck/shuffle');

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('cardsSuits', $data);
        $this->assertEquals(51, $client->getRequest()->getSession()->get('remained_cards_num'));
    }

    public function testApiDeckDraw()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/deck/draw');

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('randomCard', $data);
        $this->assertArrayHasKey('remainedCardsQuantity', $data);
    }

    public function testApisDeckDrawNumber()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/deck/draw/3');

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('randomCard', $data);
        $this->assertEquals(48, $client->getRequest()->getSession()->get('remained_cards_num'));
    }
}
