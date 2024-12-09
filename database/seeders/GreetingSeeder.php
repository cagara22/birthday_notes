<?php

namespace Database\Seeders;

use App\Models\Greeting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GreetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function (User $user) {
            Greeting::factory(20)->create([
                'user_id' => $user->id
            ]);
        });
    }
}
