<?php

declare(strict_types=1);

namespace App\Tests;

use Dbp\Relay\CoreBundle\TestUtils\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class Test extends ApiTestCase
{
    protected function setUp(): void
    {
        $this->createTestClient();
    }

    public function testIndex()
    {
        $response = $this->testClient->request('GET', '/');
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testJSONLD()
    {
        $response = $this->testClient->request('GET', '/', ['headers' => ['HTTP_ACCEPT' => 'application/ld+json']]);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent(false));
    }
}
