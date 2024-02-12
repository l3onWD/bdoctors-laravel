<?php

namespace Database\Seeders;

use App\Models\Typology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $typologies_list = config('data.typologies_list');
        foreach ($typologies_list as $typology) {
            $new_tipology = new Typology();

            $new_tipology->name = $typology['name'];
            $new_tipology->icon = $typology['icon'];

            $new_tipology->save();
        }
    }
}
