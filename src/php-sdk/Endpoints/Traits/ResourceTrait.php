<?php

namespace Ensembl260\SDK\Endpoints\Traits;

use Ensembl260\SDK\Transport\Response;

trait ResourceTrait
{
    use EndpointTrait;

    public function get(string $id): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$id");
    }

    public function post(array $data = []): Response
    {
        return $this->request->post("/{$this::getBaseUri()}", [], $data);
    }

    public function put(string $id, array $data = []): Response
    {
        return $this->request->put("/{$this::getBaseUri()}/$id", [], $data);
    }

    public function patch(string $id, array $data = []): Response
    {
        return $this->request->patch("/{$this::getBaseUri()}/$id", [], $data);
    }

    public function delete(string $id): Response
    {
        return $this->request->delete("/{$this::getBaseUri()}/$id");
    }
}
