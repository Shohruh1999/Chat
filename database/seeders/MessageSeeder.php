<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::create([
            'message' => 'salom',
            'user_id' => 1,
            'receiver_id' => 2,
            'chat_id' => 1,
        ]);
        Message::create([
           'message' => 'hello',
            'user_id' => 1,
           'receiver_id' => 3,
            'chat_id' => 2,
        ]);
        Message::create([
          'message' => 'hello',
            'user_id' => 2,
           'receiver_id' => 1,
            'chat_id' => 3,
        ]);
    }
}
