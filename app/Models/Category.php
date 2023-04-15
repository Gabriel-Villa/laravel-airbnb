<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name',
    ];

    // Querys
    public static function getAllCategories()
    {
        return Cache::remember('getAllCategories', config('cachetime.1_day_on_seconds') , function ()
        {
            return Self::all();
        });
    }

}
