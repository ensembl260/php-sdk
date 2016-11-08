<?php

namespace MR\SDK\Endpoints;

class HallNumericEndpoint extends Endpoint implements ResourceEndpointInterface
{
    /**
     * @param int $page
     * @param int $per_page
     *
     * @return \MR\SDK\Transport\Response
     */
    public function all($page = 1, $per_page = 20)
    {
        return $this->request->get('/hall-numerics', [
            'page' => $page,
            'per_page' => $per_page,
        ]);
    }

    /**
     * @param string $id
     *
     * @return \MR\SDK\Transport\Response
     */
    public function get($id)
    {
        return $this->request->get('/hall-numerics/'.$id);
    }

    /**
     * @param array $data
     *
     * @return \MR\SDK\Transport\Response
     */
    public function post(array $data)
    {
        return $this->request->post('/hall-numerics', [], $data);
    }

    /**
     * @param string $id
     * @param array  $data
     *
     * @return \MR\SDK\Transport\Response
     */
    public function put($id, array $data)
    {
        return $this->request->put('/hall-numerics/'.$id, [], $data);
    }

    /**
     * @param string $id
     * @param array  $data
     *
     * @return \MR\SDK\Transport\Response
     */
    public function patch($id, array $data)
    {
        return $this->request->patch('/hall-numerics/'.$id, [], $data);
    }

    /**
     * @param string $id
     *
     * @return \MR\SDK\Transport\Response
     */
    public function delete($id)
    {
        return $this->request->delete('/hall-numerics/'.$id);
    }

    /**
     * @param $id
     *
     * @return \MR\SDK\Transport\Response
     */
    public function getLotActivity($id)
    {
        return $this->request->get("/hall-numerics/$id/lot/activity");
    }

    /**
     * @param $id
     *
     * @return \MR\SDK\Transport\Response
     */
    public function getPlaceActivity($id)
    {
        return $this->request->get("/hall-numerics/$id/place/activity");
    }
}
