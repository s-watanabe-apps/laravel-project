<?php
namespace App\Models;

class NavigationMenus extends Model
{
    // Table name.
    public $table = 'navigation_menus';

    // Primary key.
    protected $primaryKey = 'id';

    // Timestamps.
    public $timestamps = true;

    // Multiple assignable attributes.
    protected $fillable = [
        'name',
        'link',
        'order',
    ];
}
