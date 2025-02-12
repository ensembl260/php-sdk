<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class HallNumericEndpoint extends Endpoint implements ResourceEndpointInterface
{
    use Traits\ListTrait;
    use Traits\ResourceTrait;

    public function getGroupActivity(string $id, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$id/group/activity", array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getPlaceActivity(string $id, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$id/place/activity", array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public static function getBaseUri(): string
    {
        return 'hall-numerics';
    }
}
