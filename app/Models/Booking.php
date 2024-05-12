<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'adults_number',
        'children_number',
        'emergency_contact',
        'total_amount',
        'status',
        'payment_status',
        'booking_code',
        'user_id',
        'trip_id',
    ];

    public function trip() {
        return $this->belongsTo(Trip::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
