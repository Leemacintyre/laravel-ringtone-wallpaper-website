<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ringtone;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Classical']);
        Category::create(['name' => 'Animal']);
        Category::create(['name' => 'Funny']);
        Category::create(['name' => 'SMS']);
        Category::create(['name' => 'Alarm']);
        Category::create(['name' => 'Children']);
        Category::create(['name' => 'Standard']);
        Category::create(['name' => 'Music']);
        Category::create(['name' => 'Holiday']);
        Category::create(['name' => 'Nature']);

        User::create([
            'name' => 'admin',
            'email' => 'lee@lee.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => NOW(),
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
