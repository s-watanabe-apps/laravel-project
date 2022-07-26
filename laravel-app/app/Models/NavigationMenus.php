<?php
namespace App\Models;

class NavigationMenus extends Model
{
    protected $table = 'navigation_menus';

    // Multiple assignable attributes.
    protected $fillable = [
        'name',
        'link',
        'sort',
    ];
}
