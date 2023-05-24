<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'current_price',
    ];
}
