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
    const CACHE_KEY_USERS_BY_BIRTHDAY_RANGE = 'users-birthday-range-%s-%s';
    const CACHE_KEY_LATEST_ARTICLES_BY_USER_ID = 'latest-articles-%d-%d';
    const CACHE_KEY_FAVORITE_ARTICLES_BY_USER_ID = 'favorite-articles-%d';
    const CACHE_KEY_ARTICLE_LABELS_BY_ARTICLE_ID = 'article-labels-%d';
    const CACHE_KEY_ARTICLE_LABELS_BY_USER_ID = 'article-labels-user-%d';
    const CACHE_KEY_ARTICLE_MONTHS_BY_USER_ID = 'article-months-user-%d';
    
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