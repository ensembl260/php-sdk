<?php

namespace Ensembl260\SDK\Exceptions;

use Ensembl260\SDK\Transport\Response;

class OAuthException extends \Exception
{
    private Response $response;

    public function __construct(Response $response)
    {
        parent::__construct($response->getData()['error_description'], 401, null);
        $this->response = $response;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }
}
