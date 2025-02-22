<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    protected $fillable = [
        'user_message',
        'bot_response',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
