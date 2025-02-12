<?php

namespace Ensembl260\SDK\Endpoints;

class HelpEndpoint extends Endpoint
{
    use Traits\ResourceTrait;

    public static function getBaseUri(): string
    {
        return 'help';
    }
}
