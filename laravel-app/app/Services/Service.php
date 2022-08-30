<?php
namespace App\Services;

use Closure;
use Illuminate\Support\Facades\Cache;

class Service
{
    // Service constant, cache keys.
    const CACHE_KEY_SETTINGS = 'settings';
    const CACHE_KEY_NAVIGATION_MENUS = 'navigation-menus';
    const CACHE_KEY_USERS_BY_ID = 'users-%d';
    const CACHE_KEY_USERS_BY_EMAIL = 'users-%s';
    const CACHE_KEY_USERS_BIRTHDAY = 'users-birthday-%s-%s';
    const CACHE_KEY_LATEST_ARTICLES = 'latest-articles-%d-%d';
    const CACHE_KEY_FAVORITE_ARTICLES = 'favorite-articles-%d';
    const CACHE_KEY_ARTICLE_LABELS = 'article-labels-%d';
    const CACHE_KEY_ARTICLE_LABELS_USER = 'article-labels-user-%d';
    
    /**
     * Cache remember.
     * 
     * @param string $key
     * @param Closure $function
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
     * @param Closure $function
     * @return array
     */
    private function rememberForever(string $key, Closure $function)
    {
        return Cache::rememberForever($key, $function);
    }
}