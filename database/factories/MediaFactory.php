<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'mediable_type' => 'App\\Models\\Post',
            'mediable_id' => Post::factory(),
            'file' => fake()->uuid() . '.jpg',
            'original_name' => fake()->word() . '.jpg',
            'mime_type' => 'image/jpeg',
            'size' => fake()->numberBetween(50000, 5000000),
            'alt' => fake()->sentence(3),
            'caption' => fake()->sentence(5),
            'width' => fake()->randomElement([800, 1200, 1920, 2560]),
            'height' => fake()->randomElement([600, 800, 1080, 1440]),
            'is_teaser' => false,
            'sort_order' => 0,
        ];
    }
}
