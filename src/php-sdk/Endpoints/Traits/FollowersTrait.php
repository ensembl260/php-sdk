<?php

namespace Ensembl260\SDK\Endpoints\Traits;

use Ensembl260\SDK\Transport\Response;

trait FollowersTrait
{
    use EndpointTrait;

    public function getFollowers(string $id, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$id/followers", array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }
}
