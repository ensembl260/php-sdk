<?php

namespace Ensembl260\SDK\Endpoints;

class TopicEndpoint extends Endpoint
{
    use Traits\ActivityTrait;

    /**
     * @param array $extraParams
     *
     * @return \Ensembl260\SDK\Transport\Response
     */
    public function all(array $extraParams = [])
    {
        return $this->request->get('/topics', $extraParams);
    }

    /**
     * @param string $id
     *
     * @return \Ensembl260\SDK\Transport\Response
     */
    public function get($id)
    {
        return $this->request->get('/topics/' . $id);
    }

    public static function getBaseUri(): string
    {
        return 'topic';
    }
}
