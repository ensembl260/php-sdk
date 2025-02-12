<?php

namespace Ensembl260\SDK\Endpoints;

class ShareEndpoint extends Endpoint
{
    use Traits\ResourceTrait;

    public static function getBaseUri(): string
    {
        return 'shares';
    }
}
