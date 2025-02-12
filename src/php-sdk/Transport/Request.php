<?php

namespace Ensembl260\SDK\Transport;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use Ensembl260\SDK\Client;

class Request
{
    private HttpClient $httpClient;
    private Client $client;

    public function __construct(Client $client, string $host, HandlerStack $handlerStack = null)
    {
        $this->client = $client;

        $options = ['base_uri' => $host];
        if ($handlerStack) {
            $options['handler'] = $handlerStack;
        }

        $this->httpClient = new HttpClient($options);
    }

    public function get(string $endpoint, array $parameters = [], array $data = [], array $options = []): Response
    {
        return $this->execute('GET', $endpoint, $parameters, $data, $options);
    }

    public function post(string $endpoint, array $parameters = [], array $data = [], array $options = []): Response
    {
        return $this->execute('POST', $endpoint, $parameters, $data, $options);
    }

    public function put(string $endpoint, array $parameters = [], array $data = [], array $options = []): Response
    {
        return $this->execute('PUT', $endpoint, $parameters, $data, $options);
    }

    public function patch(string $endpoint, array $parameters = [], array $data = [], array $options = []): Response
    {
        return $this->execute('PATCH', $endpoint, $parameters, $data, $options);
    }

    public function delete(string $endpoint, array $parameters = [], array $data = [], array $options = []): Response
    {
        return $this->execute('DELETE', $endpoint, $parameters, $data, $options);
    }

    public function execute(string $method, string $endpoint, array $queryParams = [], array $data = [], array $options = []): Response
    {
        $headers = [];
        if (!isset($options['authentification']) || false === $options['authentification']) {
            $accessToken = $this->client->auth()->getAccessToken();
            if ($accessToken) {
                $headers['Authorization'] = "Bearer $accessToken";
            }
        }

        if (isset($options['contentType'])) {
            $headers['Content-Type'] = $options['contentType'];
        }

        if (isset($options['contentLength'])) {
            $headers['Content-Length'] = $options['contentLength'];
        }

        $request = array_merge(['query' => $queryParams, 'headers' => $headers], $options);
        if (isset($options['form-data'])) {
            $request['form_params'] = $data;
        } else {
            $request['json'] = compact('data');
        }

        try {
            return new Response($this->httpClient->request($method, $endpoint, $request));
        } catch (RequestException $e) {
            if ($e->getCode() >= 400 && $e->getCode() < 500) {
                $this->client->getLogger()->warning($e->getMessage());
            }
            if ($e->getCode() >= 500) {
                $this->client->getLogger()->error($e->getMessage());
            }

            return new Response($e->getResponse());
        }
    }
}
