<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Code', 'Help', 'Framework', 'Migration', 'React']);
        $tags->each(function ($t) {
            Tag::create([
                'name' => $t,
                'slug' => Str::slug($t)
            ]);
        });
    }
}
