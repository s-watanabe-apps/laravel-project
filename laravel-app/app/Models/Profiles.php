<?php
namespace App\Models;

class Profiles extends Model
{
    public $timestamps = false;

    public static function query()
    {
        return parent::query()->select([
            'profiles.id',
            'profiles.type',
            'profiles.name',
            'profiles.required',
        ]);
    }

    
}
