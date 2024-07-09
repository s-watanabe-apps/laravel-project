<?php
namespace App\Models;

class NavigationMenus extends Model
{
    protected $table = 'navigation_menus';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'link',
        'order',
    ];
}
