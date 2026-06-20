<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class House extends Model
{
    protected $fillable = [
        'title', 'description', 'price_per_month', 'address', 'thumbnail', 'is_available'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
