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

        // Nombres de festivales de música alternativa/rock reales
        $eventNames = ['Reading Festival', 'Leeds Festival', 'Download Festival', 'Isle of Wight Festival', 'Rock am Ring', 'Rock im Park', 'Hellfest', 'Roskilde Festival', 'Pinkpop Festival', 'Nova Rock Festival', 'Rock Werchter', 'Main Square Festival', 'Bilbao BBK Live', 'Mad Cool Festival', 'NOS Alive'];

        // Descripciones de los festivales
        $eventDescriptions = [
            'Un festival de música que se celebra anualmente en Reading, Inglaterra, conocido por su cartel de música rock y alternativa.',
            'Hermano del Reading Festival, se celebra anualmente en Leeds, Inglaterra, y comparte el mismo cartel de música rock y alternativa.',
            'Un festival de música rock que se celebra anualmente en Donington Park, Inglaterra, conocido por su fuerte presencia de música rock y metal.',
            'Uno de los festivales de música más antiguos del mundo, se celebra anualmente en la Isla de Wight, Inglaterra, y presenta una variedad de géneros musicales.',
            'El festival de música rock más grande de Alemania, se celebra anualmente en Nürburgring.',
            'Hermano del Rock am Ring, se celebra en Núremberg, Alemania, y comparte el mismo cartel de música rock.',
            'Un festival de música heavy metal que se celebra anualmente en Clisson, Francia, conocido por su fuerte presencia de música metal.',
            'Uno de los festivales de música más grandes de Europa, se celebra anualmente en Roskilde, Dinamarca, y presenta una variedad de géneros musicales.',
            'El festival de música más antiguo de los Países Bajos, se celebra anualmente en Landgraaf.',
            'Un festival de música rock que se celebra anualmente en Nickelsdorf, Austria.',
            'Un festival de música que se celebra anualmente en Werchter, Bélgica, conocido por su cartel de música rock y alternativa.',
            'Un festival de música que se celebra anualmente en Arras, Francia, conocido por su cartel de música rock y alternativa.',
            'Un festival de música que se celebra anualmente en Bilbao, España, conocido por su cartel de música rock y alternativa.',
            'Un festival de música que se celebra anualmente en Madrid, España, conocido por su cartel de música rock y alternativa.',
            'Un festival de música que se celebra anualmente en Lisboa, Portugal, conocido por su cartel de música rock y alternativa.'
        ];

        for ($i = 0; $i < 15; $i++) {
            DB::table('events')->insert([
                'eventName' => $eventNames[$i],
                'eventDescription' => $eventDescriptions[$i],
                'eventDate' => $faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
                'location' => $faker->city,
                'eventImage' => $faker->imageUrl(640, 480, 'events'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
