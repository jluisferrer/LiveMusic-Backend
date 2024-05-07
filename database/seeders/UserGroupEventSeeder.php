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
    
        // Obtén todos los eventos
        $events = DB::table('events')->get();
    
        foreach ($events as $event) {
            // Obtén un número aleatorio de grupos
            $groups = DB::table('groups')->inRandomOrder()->take($faker->numberBetween(1, 10))->get();
    
            foreach ($groups as $group) {
                // Comprueba si el grupo ya está añadido al evento
                $existingEntry = DB::table('usergroupevent')
                    ->where('group_id', $group->id)
                    ->where('event_id', $event->id)
                    ->first();
    
                // Si no existe una entrada, crea una nueva
                if (!$existingEntry) {
                    DB::table('usergroupevent')->insert([
                        'user_id' => DB::table('users')->inRandomOrder()->first()->id,
                        'group_id' => $group->id,
                        'event_id' => $event->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }       
}
