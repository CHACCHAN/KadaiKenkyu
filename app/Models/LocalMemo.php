<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalMemo extends Model
{
    use HasFactory;

    protected $table = 'local_memos';
    
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image'
    ];
}
