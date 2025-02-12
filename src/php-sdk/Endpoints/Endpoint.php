<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Endpoints\Traits\EndpointTrait;
use Ensembl260\SDK\Transport\Request;

abstract class Endpoint
{
    use EndpointTrait;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
