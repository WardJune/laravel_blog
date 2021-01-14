<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->with('author')->latest()->paginate('6');
        return view('post.index', [
            'posts' => $posts,
            'tag' => $tag,
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }
}
