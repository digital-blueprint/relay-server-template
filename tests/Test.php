<?php

declare(strict_types=1);

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Symfony\Bundle\Test\Client;
use Symfony\Component\HttpFoundation\Response;

class Test extends ApiTestCase
{
    /** @var Client */
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    public function testIndex()
    {
        $response = $this->client->request('GET', '/');
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testJSONLD()
    {
        $response = $this->client->request('GET', '/', ['headers' => ['HTTP_ACCEPT' => 'application/ld+json']]);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent(false));
    }
}
