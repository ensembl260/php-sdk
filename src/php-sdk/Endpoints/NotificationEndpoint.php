<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class NotificationEndpoint extends Endpoint
{
    public function getRecipients(string $senderUserId, array $ids = []): Response
    {
        return $this->request->get('/notifications/recipients', [
            'ids' => $ids,
            'sender_id' => $senderUserId,
        ]);
    }

    public function getOpenTomorrow(int $page = 1, int $perPage = 100, array $extraParams = []): Response
    {
        return $this->request->get('/notifications/markets/open-tomorrow', array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getRecipientsFromMedia(string $mediaId, int $page = 1, int $perPage = 100, array $extraParams = []): Response
    {
        return $this->request->get("/notifications/media/$mediaId/recipients", array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getTopicsRecipients(array $topics, string $placeId, int $page = 1, int $perPage = 100, array $extraParams = []): Response
    {
        return $this->request->get('/notifications/topics/recipients', array_merge([
            'topics' => $topics,
            'place_id' => $placeId,
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getCustomerPublicationAndCategoriesRecipients(string $publicationId, int $page = 1, int $perPage = 100, array $extraParams = [])
    {
        return $this->request->get("/notifications/customers/publications/{$publicationId}/recipients", array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getProfile(string $id): Response
    {
        return $this->request->get("/notifications/profiles/{$id}");
    }

    public function getRecipientsByDistricts(array $parameters): Response
    {
        return $this->request->get('/notifications/districts/recipients', $parameters);
    }

    public function getPlaceRecipients(array $parameters): Response
    {
        return $this->request->get('/notifications/places/recipients', $parameters);
    }

    public static function getBaseUri(): string
    {
        return 'notifications';
    }
}
