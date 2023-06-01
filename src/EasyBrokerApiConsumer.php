<?php

namespace App;

use GuzzleHttp\Client;

class EasyBrokerApiConsumer
{
    private $apiUrl;
    private $apiToken;
    private $httpClient;

    public function __construct($apiUrl, $apiToken)
    {
        $this->apiUrl = $apiUrl;
        $this->apiToken = $apiToken;
        $this->httpClient = new Client();
    }

    public function getProperties($page = 1, $limit = 20)
    {
        $url = $this->apiUrl . '?page=' . $page . '&limit=' . $limit;

        $headers = [
            'X-Authorization' => $this->apiToken,
            'accept' => 'application/json',
        ];

        $response = $this->httpClient->request('GET', $url, [
            'headers' => $headers,
        ]);

        return $response->getBody()->getContents();
    }

    public function printTitles() {

        $data = json_decode($this->getProperties(), true);

        foreach ($data['content'] as $property) {
            echo $property['title'] . "\n";
        }
    }
}
