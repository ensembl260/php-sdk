<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class CityHallEndpoint extends Endpoint implements ResourceEndpointInterface, SettingsEndpointInterface
{
    use Traits\ListTrait;
    use Traits\ResourceTrait;
    use Traits\MembersTrait;
    use Traits\FollowersTrait;
    use Traits\ActivityTrait;
    use Traits\SettingsTrait;
    use Traits\RecommendationsTrait;

    public function getCustomers(string $id, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get("/city-halls/$id/customers", array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public static function getBaseUri(): string
    {
        return 'city-halls';
    }
}
