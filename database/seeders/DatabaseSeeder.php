<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Vincent Felix Cagara',
            'email' => 'test@example.com',
            'password' => 'cagara22'
        ]);

        $this->call(GreetingSeeder::class);
    }
}
