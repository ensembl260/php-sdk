<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class EventEndpoint extends Endpoint implements ResourceEndpointInterface
{
    use Traits\ResourceTrait;

    public function getRecipients(string $id): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$id/recipients");
    }

    public static function getBaseUri(): string
    {
        return 'events';
    }
}
