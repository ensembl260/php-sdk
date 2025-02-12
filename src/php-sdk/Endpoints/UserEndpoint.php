<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class UserEndpoint extends Endpoint implements ResourceEndpointInterface, SettingsEndpointInterface
{
    use Traits\ListTrait;
    use Traits\ResourceTrait;
    use Traits\SettingsTrait;
    use Traits\RecommendationsTrait;
    use Traits\ActivityTrait;
    use Traits\FollowersTrait;

    public function listMemberOf(string $id, string $type, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$id/member-of/$type", array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getGroups(string $id, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->listMemberOf($id, 'group', $page, $perPage, $extraParams);
    }

    public function getMemberOf(string $id, string $type, string $targetId, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$id/member-of/$type/$targetId", array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getFollowsByType(string $id, string $type, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get("/users/$id/follows/$type", array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getFollows(string $id, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get("/users/$id/follows", array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getDevices(string $id, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$id/devices", array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getServices(string $id, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$id/services", array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getByEmail(string $email): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/email/$email");
    }

    public function getByEmailId(string $emailId): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/email/id/$emailId");
    }

    public function getMemberOfByType(string $userId, string $type): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$userId/member-of/$type");
    }

    public static function getBaseUri(): string
    {
        return 'users';
    }
}
