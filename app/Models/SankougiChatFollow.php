<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatFollow extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chat_follows';

    protected $fillable = [
        'chat_user_id',
        'follow_id',
        'follower_id',
    ];
}
