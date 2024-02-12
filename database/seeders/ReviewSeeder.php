<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Review;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $profiles_ids = Profile::pluck('id')->toArray();

        foreach ($profiles_ids as $profiles_id) {
            $reviews_count = rand(0, 5);

            for ($i = 0; $i < $reviews_count; $i++) {
                $review = new Review();

                $review->profile_id =  $profiles_id;
                $review->first_name = $faker->firstName();
                $review->last_name = $faker->lastName();
                $review->email = $faker->email();
                $review->text = $faker->sentence();

                $review->save();
            }
        }
    }
}
