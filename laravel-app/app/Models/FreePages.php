<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreePages extends Model
{
    public static function add($validated) {
        $freePages = new FreePages();
        $freePages->code = $validated['free_page_code'];
        $freePages->title = $validated['title'];
        $freePages->body = $validated['body'];
        return $freePages->save();
    }
}
