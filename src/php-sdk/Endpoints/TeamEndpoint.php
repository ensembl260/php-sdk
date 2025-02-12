<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class TeamEndpoint extends Endpoint
{
    public function getTech(): Response
    {
        return $this->request->get('/teams/tech');
    }

    public function getSupport(): Response
    {
        return $this->request->get('/teams/support');
    }

    public function getCommunityManager(): Response
    {
        return $this->request->get('/teams/community-manager');
    }

    public static function getBaseUri(): string
    {
        return 'teams';
    }
}
