<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinOut extends Model
{
    use HasFactory;

    protected $table = 'joinouts';

    protected $fillable = [
        'user_id',
        'joinout_room_id',
        'class_id',
        'first_name',
        'last_name',
        'first_date',
        'last_date',
    ];
}
