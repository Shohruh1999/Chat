<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chat::create([
            'send_id' => 1,
            'user_id' => 2,
            
        ]);
        Chat::create([
            'send_id' =>1,
            'user_id' => 3,
        ]);
        Chat::create([
            'send_id' =>2,
            'user_id' => 1,
        ]);
        //
    }
}
