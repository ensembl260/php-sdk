<?php

namespace Ensembl260\SDK\Endpoints;

class PushEndpoint extends Endpoint implements ResourceEndpointInterface
{
    use Traits\ResourceTrait;
    use Traits\ListTrait;

    public static function getBaseUri(): string
    {
        return 'pushs';
    }
}
