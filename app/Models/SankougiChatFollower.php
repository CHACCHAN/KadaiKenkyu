<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatFollower extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chat_followers';

    protected $fillable = [
        'chat_user_name_id',
        'chat_user_id',
        'follower_flag',
    ];
}
