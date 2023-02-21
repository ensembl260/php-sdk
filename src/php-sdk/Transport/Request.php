<?php

namespace MR\SDK\Transport;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use MR\SDK\Client;
use MR\SDK\Exceptions\RequestException as SdkRequestException;

class Request
{
    private HttpClient $httpClient;
    private Client $client;

    public function __construct(Client $client, string $host, ?HandlerStack $handlerStack = null)
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

    public function execute(string $method, string $endpoint, array $parameters = [], array $data = [], array $options = [], int $bounces = 0): Response
    {
        $headers = [];
        if (!isset($options['anonymous']) || $options['anonymous']) {
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

        try {
            if (++$bounces > 5) {
                throw new RequestException('Redirects exceed threshold', $this);
            }

            $request = array_merge(['query' => $parameters, 'headers' => $headers], $options);
            if (isset($options['form-data'])) {
                $request['form_params'] = $data;
            } else {
                $request['json'] = compact('data');
            }

            $response = $this->httpClient->request($method, $endpoint, $request);
            if ($this->client->getOption(Client::OPT_FOLLOW_LOCATION) && $response->hasHeader('location')) {
                return $this->execute('GET', $response->getHeader('location')[0], [], [], [], $bounces++);
            }
        } catch (RequestException $re) {
            if ($this->client->getOption(Client::OPT_ERRMODE_EXCEPTION)) {
                $response = $re->getResponse();
                $body = (string) $response->getBody();
                throw new SdkRequestException(sprintf("Request Error: `%s %s`\nBody: %s", $method, $endpoint, json_encode(compact('request', 'response', 'body'), JSON_PRETTY_PRINT)), 0, $re);
            }

            $response = $re->getResponse();
        } finally {
            --$bounces;
        }

        $response = new Response($response);
        if ($this->client->getOption(Client::OPT_ERRMODE_EXCEPTION) && $errors = $response->getErrors()) {
            foreach ($errors as $error) {
                if (!isset($error['message'], $error['trace'])) {
                    continue;
                }

                $exception = (new SdkRequestException(
                    $error['message'],
                    $error['trace'],
                    isset($exception) ? $exception : null
                ))->setTrace($error['trace']);
            }

            if (isset($exception)) {
                throw $exception;
            }
        }

        return $response;
    }
}
