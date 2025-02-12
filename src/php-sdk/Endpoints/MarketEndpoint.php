<?php

namespace Ensembl260\SDK\Endpoints;

class MarketEndpoint extends Endpoint implements ResourceEndpointInterface, SettingsEndpointInterface
{
    use Traits\ListTrait;
    use Traits\ResourceTrait;
    use Traits\SettingsTrait;
    use Traits\FollowersTrait;
    use Traits\RecommendationsTrait;
    use Traits\ActivityTrait;

    public static function getBaseUri(): string
    {
        return 'markets';
    }
}
