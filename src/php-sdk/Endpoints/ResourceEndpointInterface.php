<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

interface ResourceEndpointInterface
{
    public function get(string $id): Response;

    public function post(array $data = []): Response;

    public function put(string $id, array $data = []): Response;

    public function patch(string $id, array $data = []): Response;

    public function delete(string $id): Response;
}
