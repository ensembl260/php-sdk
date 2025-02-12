<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Endpoints\Traits\ResourceTrait;

class ServiceEndpoint extends Endpoint
{
    use ResourceTrait;

    public static function getBaseUri(): string
    {
        return 'services';
    }
}
