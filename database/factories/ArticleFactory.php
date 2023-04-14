<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use \Illuminate\Support\Str as Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker = Faker::create('ru_RU');
        $name = $this->faker->text(20);
        $createdDate = $this->faker->dateTimeBetween($staretDate = '-5 years', $endDate = 'now', $timezone = null);
        return [
            "name" => $name,
            "symbolcode" => Str::slug($name, '-'),
            "content" => $this->faker->text(100),
            "created_at" =>$createdDate,
            "updated_at" => $createdDate,
            "author" => $this->faker->name(),
        ];
    }
}