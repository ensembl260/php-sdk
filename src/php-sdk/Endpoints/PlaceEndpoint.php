<?php

namespace MR\SDK\Endpoints;

class PlaceEndpoint extends Endpoint
{
    /**
     * @param int   $id
     * @param int   $page
     * @param int   $perPage
     * @param array $extraParams
     *
     * @return \MR\SDK\Transport\Response
     */
    public function get($id, $page = 1, $perPage = 20, $extraParams = [])
    {
        return $this->request->get('/places/'.$id, array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    /**
     * @param int   $page
     * @param int   $perPage
     * @param array $extraParams
     *
     * @return \MR\SDK\Transport\Response
     */
    public function getActivity($page = 1, $perPage = 20, $extraParams = [])
    {
        return $this->request->get('/places/activity', array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    /**
     * @param int   $page
     * @param int   $perPage
     * @param array $extraParams
     *
     * @return \MR\SDK\Transport\Response
     */
    public function getEvents($page = 1, $perPage = 20, $extraParams = [])
    {
        return $this->request->get('/places/events', array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    /**
     * @param $placeId
     * @param null  $radius
     * @param int   $page
     * @param int   $perPage
     * @param array $extraParams
     *
     * @return \MR\SDK\Transport\Response
     */
    public function getMap($placeId, $radius = null, $page = 1, $perPage = 20, $extraParams = [])
    {
        if ($radius) {
            $extraParams['radius'] = $radius;
        }

        return $this->request->get('/places/'.$placeId.'/map', array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    /**
     * @param int   $page
     * @param int   $perPage
     * @param array $extraParams
     *
     * @return \MR\SDK\Transport\Response
     */
    public function getMembers($page = 1, $perPage = 20, $extraParams = [])
    {
        return $this->request->get('/places/members', array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    /**
     * @param int   $page
     * @param int   $perPage
     * @param array $extraParams
     *
     * @return \MR\SDK\Transport\Response
     */
    public function getCustomers($page = 1, $perPage = 20, $extraParams = [])
    {
        return $this->request->get('/places/customers', array_merge([
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }

    /**
     * @param string $query
     * @param int    $page
     * @param int    $perPage
     * @param array  $extraParams
     *
     * @return \MR\SDK\Transport\Response
     */
    public function search($query, $page = 1, $perPage = 20, $extraParams = [])
    {
        return $this->request->get('/places/search', array_merge([
            'query' => $query,
            'page' => $page,
            'per_page' => $perPage,
        ], $extraParams));
    }
}
