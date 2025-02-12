<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class ModerationEndPoint extends Endpoint
{
    public function patch(string $type, array $data): Response
    {
        return $this->request->patch('/moderation/' . $type, [], $data);
    }

    public static function getBaseUri(): string
    {
        return 'moderation';
    }
}
