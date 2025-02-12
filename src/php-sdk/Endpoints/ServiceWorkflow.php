<?php

namespace Ensembl260\SDK\Endpoints;

use Ensembl260\SDK\Transport\Response;

class ServiceWorkflow extends Endpoint
{
    public function get(string $id): Response
    {
        return $this->request->get("/{$this::getBaseUri()}/$id");
    }

    public function post(array $data = []): Response
    {
        return $this->request->post("/{$this::getBaseUri()}", [], $data);
    }

    public function askConfirmation(string $id, array $data = []): Response
    {
        return $this->request->put("/{$this::getBaseUri()}/$id/ask-confirmation", [], $data);
    }

    public function confirm(string $id, array $data = []): Response
    {
        return $this->request->put("/{$this::getBaseUri()}/$id/confirm", [], $data);
    }

    public function askPlanning(string $id, array $data = []): Response
    {
        return $this->request->put("/{$this::getBaseUri()}/$id/ask-planning", [], $data);
    }

    public function plan(string $id, array $data = []): Response
    {
        return $this->request->put("/{$this::getBaseUri()}/$id/plan", [], $data);
    }

    public function accomplish(string $id, array $data = []): Response
    {
        return $this->request->put("/{$this::getBaseUri()}/$id/accomplish", [], $data);
    }

    public function fail(string $id, array $data = []): Response
    {
        return $this->request->put("/{$this::getBaseUri()}/$id/fail", [], $data);
    }

    public function signalProblem(string $id, array $data = []): Response
    {
        return $this->request->put("/{$this::getBaseUri()}/$id/signal-problem", [], $data);
    }

    public function cancel(string $id, array $data = []): Response
    {
        return $this->request->put("/{$this::getBaseUri()}/$id/cancel", [], $data);
    }

    public function recommend(string $id, array $data = []): Response
    {
        return $this->request->put("/{$this::getBaseUri()}/$id/recommend", [], $data);
    }

    public static function getBaseUri(): string
    {
        return 'service-workflows';
    }
}
