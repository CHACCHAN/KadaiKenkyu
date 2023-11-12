<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SankougiChatEvaluation extends Model
{
    use HasFactory;

    protected $table = 'sankougi_chat_evaluations';

    protected $fillable = [
        'user_id',
        'good_flag',
        'bad_flag',
    ];
}
