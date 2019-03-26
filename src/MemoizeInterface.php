<?php
namespace Core\Memoize;

interface MemoizeInterface
{
    public function create();

    public function get(string $key);

    public function set(string $key, callable $callee);

    public function getOrSet(string $key, callable $callee);

    public function iterator();
}
