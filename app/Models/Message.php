<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['chat_id','message','sender_name'];
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
