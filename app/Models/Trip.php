<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function transport() {
        return $this->belongsTo(Transport::class);
    }
}