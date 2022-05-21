<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition()
    {
        return [
//            'user_id'=> User::factory(),
            'user_id'=>1,
            'title'=>$this->faker->sentence,
            'post_image'=>$this->faker->imageUrl(900, 300),
            'body'=>$this->faker->paragraph,

        ];
    }
}
