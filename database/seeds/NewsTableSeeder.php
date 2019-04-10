<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        factory(\App\Models\News::class)->times(20)->create([
            'text' => function () use ($faker) {
                $text = '<p>' . $faker->text(2000) . '</p>';
                $quotes = factory(\App\Models\Quote::class)->times(2)->state('image')->create();

                foreach ($quotes as $quote) {
                    $text .= '<quote :id="' . $quote->id . '"></quote>' . '<p>' . $faker->text(2000) . '</p>';
                }

                return $text;
            },
        ]);
    }
}
