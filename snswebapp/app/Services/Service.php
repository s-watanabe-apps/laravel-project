<?php
namespace App\Services;

use Closure;
use Illuminate\Support\Facades\Cache;
use App\Http\Exceptions\ForbiddenException;
use App\Models\Roles;

class Service
{
    // Service constant, cache keys.
    const CACHE_KEY_SETTINGS = 'settings';
    const CACHE_KEY_NAVIGATION_MENUS = 'navigation-menus';
    const CACHE_KEY_INFORMATIONS = 'informations';
    const CACHE_KEY_USERS_BY_ID = 'users-%d';
    const CACHE_KEY_USERS_BY_EMAIL = 'users-%s';
    const CACHE_KEY_USERS_BY_BIRTHDAY_RANGE = 'users-birthday-range-%s-%s';
    const CACHE_KEY_LATEST_ARTICLES = 'latest-articles-%s';
    const CACHE_KEY_LATEST_ARTICLES_BY_USER_ID = 'latest-articles-%d-%d';
    //const CACHE_KEY_LATEST_ARTICLES_BY_USER_ID = 'latest-articles-%d';
    const CACHE_KEY_FAVORITE_ARTICLES_BY_USER_ID = 'favorite-articles-%d';
    const CACHE_KEY_ARTICLE_LABELS_BY_ARTICLE_ID = 'article-labels-%d';
    const CACHE_KEY_ARTICLE_LABELS_BY_USER_ID = 'article-labels-user-%d';
    const CACHE_KEY_ARTICLE_MONTHS_BY_USER_ID = 'article-months-user-%d';
    const CACHE_KEY_WEATHERS = 'wethers-%s-%s';
    
    const SORTED_ASC = '▲';
    const SORTED_DESC = '▼';

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
            $cache = Cache::rememberForever($key, $function);
        } else {
            $cache = Cache::remember($key, $ttl, $function);
        }

        return json_decode($cache, true);
    }

    /**
     * Cache purge.
     * 
     * @param string $key
     */
    protected function cacheForget($key)
    {
        Cache::forget($key);
    }

    /**
     * アクセス可否チェック.
     * 
     * @param int $sourceUserId
     * @return boolean
     */
    protected function checkAccessRight($sourceUserId)
    {
        

        return false;
    }

    /**
     * 更新可否チェック.
     * 
     * @param int $sourceUserId
     * @return void
     */
    protected function checkUpdateRight($sourceUserId)
    {
        if (user()->role_id == Roles::ADMIN || user()->role_id == Roles::SYSTEM) {
            return;
        }

        if ($sourceUserId == user()->id) {
            return;
        }

        throw new ForbiddenException();
    }
}