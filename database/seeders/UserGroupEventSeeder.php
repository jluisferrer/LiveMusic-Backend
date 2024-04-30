<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserGroupEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 40; $i++) {
            DB::table('usergroupevent')->insert([
                'user_id' => DB::table('users')->inRandomOrder()->first()->id,
                'group_id' => DB::table('group')->inRandomOrder()->first()->id,
                'event_id' => DB::table('event')->inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
