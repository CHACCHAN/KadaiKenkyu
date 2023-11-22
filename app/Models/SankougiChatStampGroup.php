<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatStampGroup extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chat_stamp_groups';

    protected $fillable = [
        'chat_user_id',
        'stamp_title',
        'stamp_content',
        'offical',
    ];
}
