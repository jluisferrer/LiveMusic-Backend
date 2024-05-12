<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->admin()->create(); //super_admin
        \App\Models\User::factory()->userTest()->create();//usertest
        \App\Models\User::factory(38)->create();
    }
}
