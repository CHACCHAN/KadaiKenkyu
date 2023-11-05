<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatComment extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chat_comments';

    protected $fillable = [
        'user_id',
        'chat_id',
        'content',
        'image', 'image_two', 'image_three', 'image_four', 'image_five',
        'good_count',
        'bad_count',
    ];
}
