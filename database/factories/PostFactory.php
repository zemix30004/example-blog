<?php

namespace Database\Factories;

use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{

    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->sentence(),
            'image' => 'photo1.png',
            'date' => '19/01/21',
            'views' => $this->faker->numberBetween(1, 10),
            'category_id' => 1,
            // 'tags' => [1, 2, 3],
            'user_id' => 1,
            'status' => 1,
            'is_featured' => 0,
        ];
    }
}
