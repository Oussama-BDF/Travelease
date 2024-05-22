<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'adults_number',
        'children_number',
        'emergency_contact',
        'total_amount',
        'status',
        'payment_status',
        'payment_token',
        'user_id',
        'trip_id',
    ];

    public function trip() {
        return $this->belongsTo(Trip::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function calculateTotalAmount($price) {
        return $price * $this->adults_number + $price * 50/100 * $this->children_number;
    }
}
