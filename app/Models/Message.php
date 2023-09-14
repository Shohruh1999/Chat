<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'user_id',
        'receiver_id',
        'chat_id',
        'confirmed',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function chat() : BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
    

    
    // public function sender(){
    //     return $this->belongsTo(User::class,'sendeder_id');
    // }
    // // public function receiver(){
    // //     return $this->belongsTo(User::class,'receiver_id');
    // // }
   
}
