<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->with('author')->latest()->paginate(6);
        return view('post.index', [
            'posts' => $posts,
            'categor' => $category,
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }
}
