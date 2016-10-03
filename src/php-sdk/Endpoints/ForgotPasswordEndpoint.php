<?php

namespace MR\SDK\Endpoints;

class ForgotPasswordEndpoint extends Endpoint
{
    /**
     * @param array $data
     * @return \MR\SDK\Transport\Response
     */
    public function postRequest(array $data)
    {
        return $this->request->post('/forgot-password/request', [], $data);
    }

    /**
     * @param $token
     * @param array $data
     * @return \MR\SDK\Transport\Response
     */
    public function getReset($token, array $data)
    {
        return $this->request->get('/forgot-password/reset/'.$token, [], $data);
    }

    /**
     * @param $token
     * @param array $data
     * @return \MR\SDK\Transport\Response
     */
    public function postReset($token, array $data)
    {
        return $this->request->patch('/forgot-password/reset/'.$token, [], $data);
    }
}
