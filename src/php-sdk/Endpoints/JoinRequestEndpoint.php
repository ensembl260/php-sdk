<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class JoinRequestEndpoint extends Endpoint
{
    public function post(array $data = []): Response
    {
        return $this->request->post('/join-requests', [], $data);
    }

    public function accept(array $data = []): Response
    {
        return $this->request->put('/join-requests/accept', [], $data);
    }

    public function decline(array $data = []): Response
    {
        return $this->request->put('/join-requests/decline', [], $data);
    }

    public function delete(array $data = []): Response
    {
        return $this->request->delete('/join-requests', [], $data);
    }

    public static function getBaseUri(): string
    {
        return 'join-requests';
    }
}
