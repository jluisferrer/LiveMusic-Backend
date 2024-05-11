<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelGroups;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        $groupNames = ['The Beatles', 'The Rolling Stones', 'Pink Floyd', 'Led Zeppelin', 'Queen', 'The Eagles', 'The Doors', 'U2', 'The Who', 'AC/DC', 'Metallica', 'Nirvana', 'Radiohead', 'Coldplay', 'Red Hot Chili Peppers', 'Green Day', 'Linkin Park', 'Maroon 5', 'Imagine Dragons', 'One Direction'];

        for ($i = 0; $i < 20; $i++) {
            DB::table('groups')->insert([
                'groupName' => $groupNames[$i],
                'groupDescription' => Str::limit($faker->paragraphs(1, true), 150),              
                'groupImage' => $faker->imageUrl(640, 480, 'groups'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
