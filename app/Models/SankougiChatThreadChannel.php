<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatThreadChannel extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chat_thread_channels';

    protected $fillable = [
        'sankougi_chat_thread_category_id',
        'title',
        'content',
    ];
}
