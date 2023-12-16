<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickUpRead extends Model
{
    use HasFactory;

    protected $table = 'pickup_reads';
    
    protected $fillable = [
        'user_id',
        'pickup_id',
        'flag'
    ];
}
