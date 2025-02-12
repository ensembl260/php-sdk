<?php

namespace Ensembl260\SDK\TokenStorage;

class InMemoryTokenStorage implements TokenStorageInterface
{
    private array $store = [];

    public function save(string $key, array $token): bool
    {
        $this->store[$key] = $token;

        return true;
    }

    public function get(string $key): ?array
    {
        return $this->has($key) ? $this->store[$key] : null;
    }

    public function has(string $key): bool
    {
        return isset($this->store[$key]);
    }

    public function remove(string $key): bool
    {
        if (!$this->has($key)) {
            return false;
        }

        unset($this->store[$key]);

        return true;
    }
}
