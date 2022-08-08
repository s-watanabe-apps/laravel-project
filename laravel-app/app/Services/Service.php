<?php
namespace App\Services;

use Closure;
use Illuminate\Support\Facades\Cache;

class Service
{
    /**
     * Cache remember.
     * 
     * @param string $key
     * @param object $json
     * @param int $ttl
     * @return array
     */
    protected function remember(string $key, Closure $function, int $ttl = null)
    {
        if (is_null($ttl)) {
            $cache = $this->rememberForever($key, $function);
        } else {
            $cache = Cache::remember($key, $ttl, $function);
        }

        return json_decode($cache);
    }

    /**
     * Cache remember forever.
     * 
     * @param string $key
     * @param object $json
     * @return array
     */
    private function rememberForever(string $key, Closure $function)
    {
        return Cache::rememberForever($key, $function);
    }
}