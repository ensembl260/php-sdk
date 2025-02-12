<?php

namespace Ensembl260\SDK\Endpoints;

class ShopEndpoint extends Endpoint implements ResourceEndpointInterface, SettingsEndpointInterface
{
    use Traits\ListTrait;
    use Traits\ResourceTrait;
    use Traits\SettingsTrait;
    use Traits\MembersTrait;
    use Traits\FollowersTrait;
    use Traits\RecommendationsTrait;
    use Traits\ActivityTrait;

    public static function getBaseUri(): string
    {
        return 'shops';
    }
}
