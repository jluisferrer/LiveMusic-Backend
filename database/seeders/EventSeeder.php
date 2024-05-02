<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 15; $i++) {
            DB::table('events')->insert([
                'eventName' => $faker->sentence,
                'eventDate' => $faker->date,
                'location' => $faker->city,
                'eventImage' => $faker->imageUrl(640, 480, 'events'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}