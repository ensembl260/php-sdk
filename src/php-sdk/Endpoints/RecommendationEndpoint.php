<?php

namespace Ensembl260\SDK\Endpoints;

class RecommendationEndpoint extends Endpoint
{
    use Traits\ResourceTrait;

    public static function getBaseUri(): string
    {
        return 'recommendations';
    }
}
