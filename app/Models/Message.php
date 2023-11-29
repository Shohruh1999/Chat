<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;


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
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
    public function hour()
    {
        $time = $this->created_at->isoFormat('LT');
        return $time;
    }
    public function date($id)//$id
    {
        $auth = auth()->user()->id;
        $message = Message::where('user_id', $auth)->where('receiver_id', $id)
        ->orwhere('receiver_id', $auth)->where('user_id',$id)->latest()->get();
        $date = $message->where('created_at', '<', $this->created_at)->first(); 
        if ($date != null) {
            if ($this->created_at->isoFormat('MMMM D, YY') != $date->created_at->isoFormat('MMMM D, YY')) {
                return $this->created_at->isoFormat('MMMM D, YY');
            }
            return null;
        }
        return $this->created_at->isoFormat('MMMM D, YY');
    }

}