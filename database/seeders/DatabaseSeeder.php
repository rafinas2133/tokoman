<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Test Admin1',
            'email' => 'admin1@admin.admin',
            'password' => 'testadmin1',
            'role_id'=>'0',
        ]);
        User::factory()->create([
            'name' => 'Test Admin2',
            'email' => 'admin2@admin.admin',
            'password' => 'testadmin2',
            'role_id'=>'0',
        ]);
        User::factory()->create([
            'name' => 'Test Admin3',
            'email' => 'admin3@admin.admin',
            'password' => 'testadmin3',
            'role_id'=>'0',
        ]);
        User::factory()->create([
            'name' => 'Test kary1',
            'email' => 'kary1@kary.kary',
            'password' => 'testkary1',
            'role_id'=>'1',
        ]);
        User::factory()->create([
            'name' => 'Test kary2',
            'email' => 'kary2@kary.kary',
            'password' => 'testkary2',
            'role_id'=>'1',
        ]);
    }
}