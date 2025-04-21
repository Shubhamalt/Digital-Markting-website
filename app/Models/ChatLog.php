<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'response'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
