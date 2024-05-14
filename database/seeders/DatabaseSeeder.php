<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            "email" => "diego@email.com",
            "password" => Hash::make("1234")
        ]);
        $this->call([CourseSeeder::class]);
    }
}
