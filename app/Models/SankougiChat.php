<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChat extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chats';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image', 'image_two', 'image_three', 'image_four', 'image_five',
        'good_count',
        'bad_count',
    ];
}
