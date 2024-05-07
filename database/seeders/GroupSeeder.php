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

        for ($i = 0; $i < 20; $i++) {
            DB::table('groups')->insert([
                'groupName' => $faker->name,
                'groupDescription' => Str::limit($faker->paragraphs(1, true), 150),              
                'groupImage' => $faker->imageUrl(640, 480, 'groups'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
