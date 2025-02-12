<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

interface SettingsEndpointInterface
{
    public function putSettings(string $id, string $key, string $value): Response;
}
