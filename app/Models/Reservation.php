<?php

namespace App\Models;

use App\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;
    use FilterByUser;

    protected $table = 'reservation';

    public $timestamps = false;

    protected $fillable = [
        'userId',
        'listingId',
        'startDate',
        'endDate',
        'totalPrice',
        'createdAt',
    ];

    protected $casts = [
        'createdAt' => 'date',
        'startDate' => 'date',
        'endDate' => 'date',
        'price' => MoneyCast::class
    ];

    protected $with = ['listing'];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listingId');
    }

}
