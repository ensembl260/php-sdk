<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class PublicationEndpoint extends Endpoint
{
    public function get(string $id): Response
    {
        return $this->request->get('/publications/' . $id);
    }

    public static function getBaseUri(): string
    {
        return 'publications';
    }
}
