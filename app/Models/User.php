<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'photo',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function message(): HasMany
    {
        return $this->hasMany(Message::class);
    }
    
    public function chat(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    public function send($auth, $user){
        $message = DB::table('messages')->where('user_id', $user->id)
        ->orwhere('user_id', $auth)->first();
        return $message;

    }
    
    public function getChat(){
        $auth= Auth::user();//auth user
        $query =$auth->chat->where('send_id', $this->id); 
        $query2= $auth->message->where('receiver_id', $this->id);
        if ( $query->max('id')<$query2->max('id')){
           foreach ($query2->groupBy('id')->first() as $message){
                return $message->message;
            }
        }
        if ($query->max('id')>$query2->max('id') ){
             foreach ($query->groupBy('id')->first() as $message){
                return $message->message->message;
            }
        }
        return null;
    }
    
    
}
