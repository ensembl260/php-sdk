<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class ForgotPasswordEndpoint extends Endpoint
{
    public function postRequest(array $data = []): Response
    {
        return $this->request->post("/{$this::getBaseUri()}/request", [], $data);
    }

    public function getReset($token, array $data = []): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/reset/$token", [], $data);
    }

    public function postReset(string $token, array $data = []): Response
    {
        return $this->request->post("/{$this::getBaseUri()}/reset/$token", [], $data);
    }

    public static function getBaseUri(): string
    {
        return 'forgot-password';
    }
}
