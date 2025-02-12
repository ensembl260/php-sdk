<?php

namespace Ensembl260\SDK\Endpoints\Traits;

use Ensembl260\SDK\Transport\Request;

trait EndpointTrait
{
    protected Request $request;

    abstract public static function getBaseUri(): string;
}
