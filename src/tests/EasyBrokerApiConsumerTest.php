<?php

namespace App\tests;

use GuzzleHttp\Exception\ClientException;
use App\EasyBrokerApiConsumer;
use PHPUnit\Framework\TestCase;

class EasyBrokerApiConsumerTest extends TestCase
{
    public function testGetProperties()
    {
        $apiUrl = 'https://api.stagingeb.com/v1/properties';
        $apiToken = 'l7u502p8v46ba3ppgvj5y2aad50lb9';

        $consumer = new EasyBrokerApiConsumer($apiUrl, $apiToken);
        $response = $consumer->getProperties();

        $this->assertIsString($response);
        $this->assertNotEmpty($response);
    }

    public function testGetPropertiesWithPageAndLimit()
    {
        $apiUrl = 'https://api.stagingeb.com/v1/properties';
        $apiToken = 'l7u502p8v46ba3ppgvj5y2aad50lb9';

        $consumer = new EasyBrokerApiConsumer($apiUrl, $apiToken);
        $response = $consumer->getProperties(2, 10);

        $this->assertIsString($response);
        $this->assertNotEmpty($response);
    }

    public function testGetPropertiesWithInvalidToken()
    {
        $apiUrl = 'https://api.stagingeb.com/v1/properties';
        $apiToken = 'invalid_token';

        $consumer = new EasyBrokerApiConsumer($apiUrl, $apiToken);

        try {
            $consumer->getProperties();
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody()->getContents(), true);
            $errorMessage = $responseData['error'];

            $this->assertEquals(401, $statusCode);
            $this->assertEquals('Your API key is invalid', $errorMessage);
            return;
        }

        $this->fail('Expected ClientException was not thrown.');
    }
}