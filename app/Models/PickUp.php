<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickUp extends Model
{
    use HasFactory;

    protected $table = 'pickups';
    
    protected $fillable = [
        'title',
        'content',
        'type',
        'image'
    ];
}
