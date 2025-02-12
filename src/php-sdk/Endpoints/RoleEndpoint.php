<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class RoleEndpoint extends Endpoint
{
    public function all(string $type = null, array $extraParams = []): Response
    {
        if ($type) {
            $extraParams['type'] = $type;
        }

        return $this->request->get('/roles', $extraParams);
    }

    public static function getBaseUri(): string
    {
        return 'roles';
    }
}
