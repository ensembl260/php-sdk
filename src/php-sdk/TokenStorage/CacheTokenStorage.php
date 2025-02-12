<?php

namespace Ensembl260\SDK\TokenStorage;

use Psr\Cache\CacheItemPoolInterface;

class CacheTokenStorage implements TokenStorageInterface
{
    private CacheItemPoolInterface $cache;

    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    public function save(string $key, array $token): bool
    {
        $item = $this->cache->getItem($key);
        $item->set(serialize($token));
        $item->expiresAfter(5184000); // 60 days in seconds => see config.yml in API

        return $this->cache->save($item);
    }

    public function get(string $key): ?array
    {
        $item = $this->cache->getItem($key);

        return $item->isHit() ? unserialize($item->get()) : null;
    }

    public function has(string $key): bool
    {
        return $this->cache->getItem($key)->isHit();
    }

    public function remove(string $key): bool
    {
        return $this->cache->deleteItem($key);
    }
}
