<?php

namespace Ensembl260\SDK\Endpoints;

class MediaEndpoint extends Endpoint
{
    use Traits\ResourceTrait;

    public static function getBaseUri(): string
    {
        return 'medias';
    }
}
