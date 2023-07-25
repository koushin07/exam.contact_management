<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'username' => 'Test',
            'first_name' => 'test',
            'last_name' => 'test',
            'address' => 'address',
            'contact_number' => '123',
            'password' => '1234'
        ]);
    }
}
