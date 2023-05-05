<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Listing extends Model
{
    use HasFactory;

    protected $table = 'listing';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'roomCount',
        'bathroomCount',
        'guestCount',
        'locationId',
        'categoryId',
        'userId',
        'price',
    ];

    protected $casts = [
        'price' => MoneyCast::class
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // protected function price(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (int|float $value) => number_format($value * 100),
    //         set: fn (int|float $value) => $value / 100,
    //     );
    // }

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => [
                'title' => Str::headline($value),
                'slug' => Str::slug($value, '-'),
            ],
        );
    }

    public function getPriceWithOutFormat()
    {
        return $this->getRawOriginal('price');
    }

    protected $with = ['location', 'category', 'user', 'images', 'image'];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'locationId', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoryId', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ListingImages::class, 'listingId', 'id');
    }
    public function image(): HasOne
    {
        return $this->hasOne(ListingImages::class, 'listingId', 'id');
    }

}
