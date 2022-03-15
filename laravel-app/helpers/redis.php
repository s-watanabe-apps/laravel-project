<?php
declare(strict_types = 1);

if (!function_exists('redis')) {
    /**
     * @return string
     */
    function redis(): bool
    {
        return config('cache.default') == 'redis';
    }
}