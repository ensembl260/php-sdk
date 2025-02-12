<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class SitemapEndpoint extends Endpoint
{
    public function getPublications(string $types = null, string $scrollId = null): Response
    {
        if (!$scrollId) {
            return $this->request->get('/sitemap/publications', ['initial' => 1, 'types' => $types]);
        }

        return $this->request->get('/sitemap/publications', ['scroll_id' => $scrollId, 'types' => $types]);
    }

    public function getProfiles(string $types = null, string $scrollId = null): Response
    {
        if (!$scrollId) {
            return $this->request->get('/sitemap/profiles', ['initial' => 1, 'types' => $types]);
        }

        return $this->request->get('/sitemap/profiles', ['scroll_id' => $scrollId, 'types' => $types]);
    }

    public function getTopics(string $interval = null, int $maxResult = null): Response
    {
        return $this->request->get('/sitemap/topics', ['interval' => $interval, 'max_result' => $maxResult]);
    }

    public static function getBaseUri(): string
    {
        return 'sitemap';
    }
}
