<?php

namespace Oh86\OtherSmCryptor\Api;

use GuzzleHttp\Client;
use Illuminate\Config\Repository;
use Oh86\OtherSmCryptor\Exceptions\ApiRequestException;

class OtherGMApi
{
    private string $url;
    private Client $client;

    /**
     * @param array{host: string} $config
     */
    public function __construct(array $config)
    {
        $this->url = $config['host'];

        $this->client = new Client();
    }

    public function setHttpClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Parse JSON response content into a Repository instance.
     *
     * @param string $content The JSON response content to parse.
     *
     * @return Repository The parsed JSON content as a Repository instance.
     */
    private function parseJson(string $content): Repository
    {
        $data = json_decode($content, true);
        return new Repository($data);
    }

    /**
     * @throws ApiRequestException
     */
    public function sm3(string $text): string
    {
        $url = $this->url . '/sm3';
        $params = [
            'data' => $text
        ];
        $response = $this->client->post($url, ['json' => $params]);
        $content = $response->getBody()->getContents();

        $jsonResult = $this->parseJson($content);
        if ($jsonResult->get('code') !== 0) {
            throw new ApiRequestException($response->getStatusCode(), $content, $url, $params);
        }

        return $jsonResult->get('data.result');
    }

    public function hmacSm3(string $text): string
    {
        $url = $this->url . '/hmacSm3';
        $params = [
            'data' => $text
        ];
        $response = $this->client->post($url, ['json' => $params]);
        $content = $response->getBody()->getContents();

        $jsonResult = $this->parseJson($content);
        if ($jsonResult->get('code') !== 0) {
            throw new ApiRequestException($response->getStatusCode(), $content, $url, $params);
        }

        return $jsonResult->get('data.result');
    }

    public function sm4Encrypt(string $text): string
    {
        $url = $this->url . '/sm4Encrypt';
        $params = [
            'data' => $text,
        ];
        $response = $this->client->post($url, ['json' => $params]);
        $content = $response->getBody()->getContents();

        $jsonResult = $this->parseJson($content);
        if ($jsonResult->get('code') !== 0) {
            throw new ApiRequestException($response->getStatusCode(), $content, $url, $params);
        }

        return $jsonResult->get('data.result');
    }

    public function sm4Decrypt(string $cipherText): string
    {
        $url = $this->url . '/sm4Decrypt';
        $params = [
            'data' => $cipherText,
        ];
        $response = $this->client->post($url, ['json' => $params]);
        $content = $response->getBody()->getContents();

        $jsonResult = $this->parseJson($content);
        if ($jsonResult->get('code') !== 0) {
            throw new ApiRequestException($response->getStatusCode(), $content, $url, $params);
        }

        return $jsonResult->get('data.result');
    }

    public function sm2GenSign(string $text): string
    {
        $url = $this->url . '/sm2GenSign';
        $params = [
            'data' => $text
        ];
        $response = $this->client->post($url, ['json' => $params]);
        $content = $response->getBody()->getContents();

        $jsonResult = $this->parseJson($content);
        if ($jsonResult->get('code') !== 0) {
            throw new ApiRequestException($response->getStatusCode(), $content, $url, $params);
        }

        return $jsonResult->get('data.result');
    }

    public function sm2VerifySign(string $text, string $sign): bool
    {
        $url = $this->url . '/sm2VerifySign';
        $params = [
            'data' => $text,
            'sign' => $sign
        ];
        $response = $this->client->post($url, ['json' => $params]);
        $content = $response->getBody()->getContents();

        $jsonResult = $this->parseJson($content);
        if ($jsonResult->get('code') !== 0) {
            throw new ApiRequestException($response->getStatusCode(), $content, $url, $params);
        }

        return $jsonResult->get('data.result');
    }
}
