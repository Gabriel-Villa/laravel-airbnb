<?php

namespace App\Models;

use App\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'createdAt' => 'date'
    ];

    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn (int|float $value) => $value * 100,
            set: fn (int|float $value) => $value / 100,
        );
    }

}
