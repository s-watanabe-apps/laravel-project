<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
