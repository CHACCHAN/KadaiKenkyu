<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatThreadJob extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chat_thread_jobs';

    protected $fillable = [
        'sankougi_chat_thread_id',
        'chat_user_id',
        'admin_flag',
    ];
}
