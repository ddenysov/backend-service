<?php

namespace App\Tests\Shared;

use App\Tests\Shared\Response\Response;
use App\Tests\Shared\Utils\ArrayUtils;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Uid\Uuid;

abstract class ApiTestCase extends WebTestCase
{
    use ArrayUtils;

    /**
     * @param string $url
     * @return void
     */
    protected function get(string $url): void
    {
        $this->request($url, 'GET');
    }

    /**
     * @param string $url
     * @param array $data
     * @return void
     */
    protected function post(string $url, array $data = []): void
    {
        $this->request($url, 'POST', $data);
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $data
     * @return void
     */
    protected function request(string $url, string $method, array $data = []): void
    {
        if (!static::$booted) {
            $client = static::createClient();
        } else {
            $client = static::$kernel->getContainer()->get('test.client');
        }

        $client->request($method, $url, $data);
    }

    /**
     * @return Response
     */
    protected function response(): Response
    {
        return new Response(json_decode(self::getClient()->getResponse()->getContent(), true));
    }

    /**
     * @param string $path
     * @return bool
     */
    protected function assertJsonResponsePathExists(string $path): void
    {
        $this->assertTrue($this->response()->jsonPathExists($path));
    }

    /**
     * @param string $path
     * @return void
     */
    protected function assertJsonResponsePathIsUUID(string $path): void
    {
        $this->assertTrue(Uuid::isValid($this->response()->jsonPath($path)));
    }

    /**
     * @param string $path
     * @param string $expected
     * @return void
     */
    protected function assertJsonResponsePathEquals(string $path, string $expected): void
    {
        $this->assertEquals($expected, $this->response()->jsonPath($path));
    }
}
