<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatUser extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chat_users';

    protected $fillable = [
        'user_id',
        'content',
        'fllow_count',
        'fllower_count',
        'image_header',
        'image_avatar',
    ];
}
