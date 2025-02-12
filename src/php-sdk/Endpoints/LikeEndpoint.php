<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class LikeEndpoint extends Endpoint
{
    public function post(array $data = []): Response
    {
        return $this->request->post('/likes', [], $data);
    }

    public function delete(array $data = []): Response
    {
        return $this->request->delete('/likes', [], $data);
    }

    public static function getBaseUri(): string
    {
        return 'likes';
    }
}
