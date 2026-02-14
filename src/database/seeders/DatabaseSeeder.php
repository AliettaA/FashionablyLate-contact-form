<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\CategoriesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
        $this->call(CategoriesTableSeeder::class);
        \App\Models\Contact::factory(35)->create();
    }
}
