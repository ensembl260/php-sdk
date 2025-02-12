<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class MemberOfEndpoint extends Endpoint
{
    public function post(array $data = []): Response
    {
        return $this->request->post('/members', [], $data);
    }

    public function put(array $data = []): Response
    {
        return $this->request->put('/members', [], $data);
    }

    public function delete(array $data = []): Response
    {
        return $this->request->delete('/members', [], $data);
    }

    public static function getBaseUri(): string
    {
        return 'members';
    }
}
