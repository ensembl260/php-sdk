<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class CardEndpoint extends Endpoint
{
    public function get(string $id): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$id");
    }

    public function all(string $type = null, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        throw new \RuntimeException('Not implemented');
    }

    public function delete(string $id, array $data = []): Response
    {
        return $this->request->delete("/{$this::getBaseUri()}/{$id}", [], $data);
    }

    public static function getBaseUri(): string
    {
        return 'cards';
    }
}
