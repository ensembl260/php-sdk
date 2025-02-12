<?php

namespace Ensembl260\SDK\Endpoints\Traits;

use Ensembl260\SDK\Transport\Response;

trait SettingsTrait
{
    use EndpointTrait;

    /**
     * @deprecated
     */
    public function putSettings(string $id, string $key, string $value): Response
    {
        return $this->setSettings($id, $key, $value);
    }

    public function setSettings(string $id, string $key, string $value): Response
    {
        return $this->request->put("/{$this::getBaseUri()}/$id/settings/$key", [], [
            'value' => $value,
        ]);
    }
}
