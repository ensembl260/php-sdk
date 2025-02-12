<?php

namespace Ensembl260\SDK\Transport;

use GuzzleHttp\Psr7\Response as Psr7Response;
use GuzzleHttp\Utils;

class Response
{
    private array $data = [];
    private string $content;
    private array $errors = [];
    private array $metadata = [];

    private Psr7Response $response;

    public function __construct(Psr7Response $response)
    {
        $this->response = $response;
        $this->decodeContent();
    }

    public function getInnerResponse(): Psr7Response
    {
        return $this->response;
    }

    public function getData(string $key = null): ?array
    {
        return $key ? $this->get("data.{$key}") : $this->data;
    }

    public function get(string $key)
    {
        if (!strpos($key, '.')) {
            return isset($this->data[$key]) ? $this->data[$key] : null;
        }

        $current = &$this->data;
        foreach (explode('.', $key) as $part) {
            if (!isset($current[$part])) {
                return null;
            }

            $current = &$current[$part];
        }

        return $current;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function getLocation(): string
    {
        return $this->response->getHeaderLine('location');
    }

    public function isPaginate(): bool
    {
        return 206 === $this->response->getStatusCode();
    }

    private function decodeContent(): void
    {
        $this->content = trim((string) $this->response->getBody());

        if (!$this->content) {
            return;
        }

        if (in_array($this->response->getStatusCode(), [201, 202, 204])) {
            return;
        }

        try {
            $data = Utils::jsonDecode($this->content, true);
        } catch (\Exception $e) {
            return;
        }

        $this->errors = isset($data['errors']) ? $data['errors'] : [];
        $this->metadata = isset($data['metadata']) ? $data['metadata'] : [];
        $this->data = isset($data['data']) ? $data['data'] : [];
    }

    public function __toString(): string
    {
        return (string) $this->response->getBody();
    }
}
