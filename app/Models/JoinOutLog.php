<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinOutLog extends Model
{
    use HasFactory;

    protected $table = 'joinout_logs';

    protected $fillable = [
        'joinout_id',
        'joinout_room_id',
    ];
}
