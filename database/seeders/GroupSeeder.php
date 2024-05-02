<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('groups')->insert([
                'groupName' => $faker->name,               
                'groupImage' => $faker->imageUrl(640, 480, 'events'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
