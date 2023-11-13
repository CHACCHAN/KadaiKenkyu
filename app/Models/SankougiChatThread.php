<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatThread extends Model
{
    use HasFactory;
    
    protected $table = 'sankougi_chat_threads';

    protected $fillable = [
        'chat_user_id',
        'title',
        'content',
        'join_count',
    ];
}
