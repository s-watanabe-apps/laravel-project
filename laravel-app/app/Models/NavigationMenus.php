<?php
namespace App\Models;

class NavigationMenus extends Model
{
    // Table name.
    public $table = 'navigation_menus';

    // Multiple assignable attributes.
    protected $fillable = [
        'name',
        'link',
        'order',
    ];
}
