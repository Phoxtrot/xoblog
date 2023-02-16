<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Article;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class articleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->text(50);
        $slugValue = SlugService::createSlug(Article::class, 'slug', $title);
        $category =Category::inRandomOrder()->first()->id;
        return [
            'title' => $title,
            'body' => $this->faker->text(2000),
            'image' => $this->faker->image('public/public/Image',765,400,null,false),
            'featured' => 1,
            'published' => 1,
            'slug'=>$slugValue,
            'user_id'=>1,
            'category_id' => $category
        ];
    }
}
