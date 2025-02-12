<?php

namespace Ensembl260\SDK\TokenStorage;

class FileTokenStorage implements TokenStorageInterface
{
    protected string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function save(string $key, array $token): bool
    {
        return false !== file_put_contents("{$this->path}/{$key}", json_encode($token, JSON_PRETTY_PRINT), LOCK_EX);
    }

    public function has($key): bool
    {
        return file_exists("{$this->path}/{$key}");
    }

    public function get(string $key): ?array
    {
        return $this->has($key) ? json_decode(file_get_contents("{$this->path}/{$key}"), true) : null;
    }

    public function remove(string $key): bool
    {
        return unlink("{$this->path}/{$key}");
    }
}
