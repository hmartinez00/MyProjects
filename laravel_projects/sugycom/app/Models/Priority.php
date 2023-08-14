<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priorities extends Model
{
    use HasFactory;

    protected $fillabel = [
        'satellite',
        'target',
        'latitude',
        'longitude',
        'duration',
        'vh_angle',
        'mode',
        'sensor',
        'status',
        'code',
        'closing_date',
    ];
}
