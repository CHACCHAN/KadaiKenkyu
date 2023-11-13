<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatThreadJoin extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chat_thread_joins';

    protected $fillable = [
        'sankougi_chat_thread_id',
        'chat_user_id',
    ];
}
