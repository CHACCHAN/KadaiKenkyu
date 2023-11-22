<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatStamp extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chat_stamps';

    protected $fillable = [
        'sankougi_chat_stamp_group_id',
        'image',
    ];
}
