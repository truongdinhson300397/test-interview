<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Tin tức', 'Review', 'Event'];
        foreach ($data as $item) {
            Category::query()->create([
               'name' =>  $item
            ]);
        }

        Category::factory(10)->create();
    }
}
