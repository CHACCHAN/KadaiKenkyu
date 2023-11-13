<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatThreadCategory extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chat_thread_categorys';

    protected $fillable = [
        'sankougi_chat_thread_id',
        'title',
    ];
}
