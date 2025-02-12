<?php

namespace Ensembl260\SDK\Endpoints;

class TransactionEndpoint extends Endpoint
{
    use Traits\ResourceTrait;

    public static function getBaseUri(): string
    {
        return 'transactions';
    }
}
