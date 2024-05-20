<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination',
        'start_at',
        'end_at',
        'price',
        'description',
        'accommodation',
        'transport_id',
        'max_travelers',
    ];

    public function transport() {
        return $this->belongsTo(Transport::class);
    }

    public function activities() {
        return $this->hasMany(Activity::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function getStatusAttribute()
    {
        $now = Carbon::now()->format('Y-m-d');

        if ($this->end_at < $now) {
            return [
                'availability' => false,
                'status' => 'completed',
                'class' => 'completed',
            ];
        } elseif ($this->start_at <= $now) {
            return [
                'availability' => false,
                'status' => 'ongoing',
                'class' => 'ongoing',
            ];
        }
        if ($this->current_travelers === $this->max_travelers) {
            return [
                'availability' => false,
                'status' => 'fully booked',
                'class' => 'full',
            ];
        }

        return [
            'availability' => true,
            'status' => $this->max_travelers - $this->current_travelers . ' places available',
            'class' => 'upcoming',
        ];
    }

}
