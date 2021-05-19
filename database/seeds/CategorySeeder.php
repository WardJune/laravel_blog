<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect(['Laravel', 'CSS', 'PHP', 'HTML']);
        $categories->each(function ($c) {
            Category::create([
                'name' => $c,
                'slug' => Str::slug($c),
            ]);
        });
    }
}
