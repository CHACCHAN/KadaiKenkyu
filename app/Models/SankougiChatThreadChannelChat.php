<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatThreadChannelChat extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chat_thread_channel_chats';

    protected $fillable = [
        'sankougi_chat_thread_channel_id',
        'chat_user_id',
        'content',
        'image',
        'stamp',
    ];
}
