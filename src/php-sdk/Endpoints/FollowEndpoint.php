<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class FollowEndpoint extends Endpoint
{
    public function post(array $data = []): Response
    {
        return $this->request->post("/{$this::getBaseUri()}", [], $data);
    }

    public function delete(array $data = []): Response
    {
        return $this->request->delete("/{$this::getBaseUri()}", [], $data);
    }

    public static function getBaseUri(): string
    {
        return 'follows';
    }
}
