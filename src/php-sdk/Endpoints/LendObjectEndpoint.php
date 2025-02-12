<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class LendObjectEndpoint extends Endpoint
{
    public function all(): Response
    {
        return $this->request->get('/lend-objects', []);
    }

    public function delete(string $id): Response
    {
        return $this->request->delete("/lend-objects/{$id}", []);
    }

    public static function getBaseUri(): string
    {
        return 'lend-objects';
    }
}
