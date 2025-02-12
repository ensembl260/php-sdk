<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class PlaceEndpoint extends Endpoint
{
    public function get(string $id, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get('/places/' . $id, array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getActivity(int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get('/places/activity', array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getEvents(int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get('/places/events', array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getCivicActions(int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get('/places/civic-actions', array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getMap($placeId, $radius = null, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        if ($radius) {
            $extraParams['radius'] = $radius;
        }

        return $this->request->get('/places/' . $placeId . '/map', array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getMembers($parameters): Response
    {
        return $this->request->get('/places/members', $parameters);
    }

    public function getCustomers(int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get('/places/customers', array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function search(string $query, int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get('/places/search', array_merge([
            'query' => $query,
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getTown(string $placeId, array $extraParams = []): Response
    {
        return $this->request->get('/places/' . $placeId . '/town', $extraParams);
    }

    public function getNeighbourhoodPublications(
        string $longitude,
        string $latitude,
        string $placeType,
        int $page = 1,
        int $perPage = 20,
        array $extraParams = []
    ): Response {
        return $this->request->get('/places/lng/' . $longitude . '/lat/' . $latitude . '/publications', array_merge([
            'place_type' => $placeType,
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getNeighbourhoodCounters(string $longitude, string $latitude, string $placeType, array $extraParams = []): Response
    {
        return $this->request->get('/places/lng/' . $longitude . '/lat/' . $latitude . '/counters', array_merge([
            'place_type' => $placeType,
        ], $extraParams));
    }

    public function getServices(int $page = 1, int $perPage = 20, array $extraParams = []): Response
    {
        return $this->request->get('/places/services', array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    public function getUsersByPlaceId(string $placeId, array $parameters): Response
    {
        return $this->request->get('/places/' . $placeId . '/users', $parameters);
    }

    public static function getBaseUri(): string
    {
        return 'place';
    }
}
