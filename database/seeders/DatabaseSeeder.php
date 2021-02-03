<?php

namespace Database\Seeders;

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
        \App\Models\User::factory()->createOne([
            'name' => 'Pedro',
            'email' => 'ramospedro21@outlook.com',
            'password' => bcrypt('123456'),
        ]);
        \App\Models\User::factory(10)->create();
        $this->call(MoviesSeeder::class);
    }
}
