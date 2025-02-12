<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class AssociationEndpoint extends Endpoint implements ResourceEndpointInterface, SettingsEndpointInterface
{
    use Traits\ListTrait;
    use Traits\ResourceTrait;
    use Traits\MembersTrait;
    use Traits\FollowersTrait;
    use Traits\ActivityTrait;
    use Traits\SettingsTrait;
    use Traits\RecommendationsTrait;

    public static function getBaseUri(): string
    {
        return 'associations';
    }

    public function acceptAssociationInvitation(string $associationId, string $invitationToken): Response
    {
        return $this->request->put("/{$this::getBaseUri()}/$associationId/invitations/$invitationToken/accept", [], []);
    }
}
