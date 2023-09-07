<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'sendeder_id',
        'receiver_id',
    ];
    public function sender(){
        return $this->hasOne(User::class,'sendeder_id');
    }
    public function receiver(){
        return $this->hasOne(User::class,'receiver_id');
    }
   
}
