<?php

namespace Ensembl260\SDK\Endpoints;

class TradeEndpoint extends Endpoint
{
    use Traits\ResourceTrait;

    public static function getBaseUri(): string
    {
        return 'trades';
    }
}
