<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(100)->create();
        $categories = Category::query()->inRandomOrder()->limit(3)->pluck('id')->toArray();
        $posts = Post::query()->get();
        foreach ($posts as $post) {
            $post->category()->sync($categories);
        }
    }
}
