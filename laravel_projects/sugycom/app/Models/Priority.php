<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'created_at',
        'updated_at',
        'closing_date',
    ];
}
