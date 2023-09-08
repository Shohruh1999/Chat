<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'shohruh',
            'email' => 'shohruhegamberdiyev9@gmail.com',
            'password' => bcrypt('12345'),
        ]);
        User::create([
            'name' => 'shahzod',
            'email' => 'shahzod@gmail.com',
            'password' => Hash::make('123456'), 
        ]);
        User::create([
            'name' => 'sardor',
            'email' => 'sardor@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $users = User::factory()->count(10)->create();
        //
    }
}
