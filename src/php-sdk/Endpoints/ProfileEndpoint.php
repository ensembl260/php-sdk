<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class ProfileEndpoint extends Endpoint
{
    public function get(string $id): Response
    {
        return $this->request->get('/profiles/' . $id);
    }

    public static function getBaseUri(): string
    {
        return 'profiles';
    }
}
