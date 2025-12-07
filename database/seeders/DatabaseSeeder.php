<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'email_verified_at' => now(),
             'password' => Hash::make('123456'),
             'remember_token' => Str::random(10),
         ]);

         \App\Models\User::factory()->create([
             'name' => 'Test User 2',
             'email' => 'test2@example.com',
             'email_verified_at' => now(),
             'password' => Hash::make('123456'),
             'remember_token' => Str::random(10),
         ]);


        \App\Models\User::factory(5)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Item::factory(100)->create();
//        \App\Models\ItemPhoto::factory(100)->create();
    }
}
