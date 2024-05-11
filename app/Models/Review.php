<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'review',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
