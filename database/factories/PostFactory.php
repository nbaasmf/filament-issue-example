<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subcat = Subcategory::inRandomOrder()->first();

        return [
            'title' => $this->faker->sentence,
            'category_id' => $subcat->category_id,
            'subcategory_id' => $subcat->id,
            'user_id' => UserFactory::new(),
        ];
    }
}
