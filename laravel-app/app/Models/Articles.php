<?php
namespace App\Models;

use App\Models\Images;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Articles extends Model
{
    use SoftDeletes;

    protected $table = 'articles';

    // Model constants.
    const TYPE_MEMBER_ARTICLE = 1;

    // Multiple assignable attributes.
    protected $fillable = [
        'user_id',
        'type',
        'status',
        'title',
        'body',
    ];
}
