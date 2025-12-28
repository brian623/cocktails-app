<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    protected $fillable = [
        'external_id',
        'name',
        'category',
        'alcoholic',
        'thumbnail',
    ];
}
