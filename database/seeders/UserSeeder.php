<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Star;
use App\Models\Typology;
use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        // Retrieve typologies ids
        $typologies_ids = Typology::pluck('id')->toArray();

        // Retrieve stars ids
        $stars_ids = Star::pluck('id')->toArray();

        // Make profile photo directory
        Storage::makeDirectory('profile_img');

        // Get Photos Source Images
        $photoMalesSources = Storage::files('sources/profile_males');
        $photoFemalesSources = Storage::files('sources/profile_females');

        for ($i = 1; $i < 10; $i++) {

            // Choose gender
            $gender = rand(0, 1) ? 'male' : 'female';

            // Create Doctor
            $doctor = new User();
            $doctor->first_name = $faker->firstName($gender);
            $doctor->last_name = $faker->lastName();
            $doctor->email = "doctor$i@mail.it";
            $doctor->password = bcrypt('password');
            $doctor->save();

            // Create profile
            $doctor_profile = new Profile();
            $doctor_profile->user_id = $doctor->id;
            $doctor_profile->description = $faker->sentence();
            $doctor_profile->services = $faker->words(rand(1, 5), true);
            $doctor_profile->address = 'Roma';

            // Add a profile image (66% chance)
            if (rand(0, 2)) {

                // Get source based on gender
                $photoSources = $gender === 'male' ? $photoMalesSources : $photoFemalesSources;

                // Choose a random photo
                $src_url = Storage::path(Arr::random($photoSources));
                $photo_url = Storage::putFile('profile_img', $src_url);

                // Save photo url
                $doctor_profile->photo = $photo_url;
            }

            $doctor_profile->save();

            // Add doctor typologies (at least one)
            $profile_typologies = [];
            foreach ($typologies_ids as $typology_id) {
                if (rand(0, 3) > 2) $profile_typologies[] = $typology_id;
            }
            if (!count($profile_typologies)) $profile_typologies[] = Arr::random($typologies_ids);

            $doctor_profile->typologies()->attach($profile_typologies);


            // Add random doctor valutations
            $profile_stars = [];
            $stars_count = rand(0, 10);
            for ($j = 0; $j < $stars_count; $j++) {
                $profile_stars[] = Arr::random($stars_ids);
            }

            $doctor_profile->stars()->attach($profile_stars);
        }
    }
}
