<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Listing extends Model
{
    use HasFactory;

    protected $table = 'listing';

    protected $fillable = [
        'title',
        'description',
        'roomCount',
        'bathroomCount',
        'guestCount',
        'locationId',
        'categoryId',
        'userId',
    ];

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
