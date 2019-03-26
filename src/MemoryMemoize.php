<?php
namespace Core\Memoize;

class MemoryMemoize implements MemoizeInterface
{
    private $cache;

    public function __construct()
    {
        $this->cache = [];
    }

    public function create()
    {
        return new self();
    }

    public function get(string $key)
    {
        if (!array_key_exists($key, $this->cache)) {
            throw new \OutOfBoundsException($key);
        }
        return $this->cache[$key];
    }

    public function set(string $key, callable $callee)
    {
        $this->cache[$key] = call_user_func($callee);
    }

    public function getOrSet(string $key, callable $callee)
    {
        try {
            return $this->get($key);
        } catch (\OutOfBoundsException $e) {
            $this->set($key, $callee);
        }
        return $this->get($key);
    }

    public function iterator()
    {
        return new \ArrayIterator($this->cache);
    }
}
