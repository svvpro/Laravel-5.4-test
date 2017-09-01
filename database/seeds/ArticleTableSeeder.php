<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('articles')->insert([
                'title' => $faker->sentence,
                'text' => $faker->paragraph(5),
                'slug' => $faker->slug,
                'image' => $faker->imageUrl(640, 480),
                'user_id' => $faker->numberBetween(1, 2),
                'category_id' => $faker->numberBetween(0, 2),
                'created_at' => $faker->dateTime
            ]);
        }
    }
}
