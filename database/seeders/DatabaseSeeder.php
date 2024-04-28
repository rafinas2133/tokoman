<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        for ($i = 0; $i < 10; $i++) {
        User::factory()->create([
            'name' => 'Test User'.$i,
            'email' => $faker->unique()->safeEmail,
            'password' => 'testadmin'
        ]);
        }
    }
}