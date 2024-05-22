<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
    ];
}
