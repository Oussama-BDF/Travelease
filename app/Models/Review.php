<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'rating',
        'review',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
