<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class CategoryEndpoint extends Endpoint
{
    public const TYPE_INTEREST = 'interest';
    public const TYPE_SERVICE = 'service';
    public const TYPE_GOOD = 'good';
    public const TYPE_BADGE = 'badge';
    public const TYPE_ASSOCIATION = 'association';

    public function all(string $type = null, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get("/{$this::getBaseUri()}", array_merge([
            'type' => $type,
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function get(string $id): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$id");
    }

    public static function getBaseUri(): string
    {
        return 'categories';
    }
}
