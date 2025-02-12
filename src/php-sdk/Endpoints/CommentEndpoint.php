<?php

namespace Ensembl260\SDK\Endpoints;

class CommentEndpoint extends Endpoint implements ResourceEndpointInterface
{
    use Traits\ResourceTrait;

    public static function getBaseUri(): string
    {
        return 'comments';
    }
}
