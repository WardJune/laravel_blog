<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function post()
    {
        $keyword = request('keyword');
        $posts = Post::where("title", "like", "%$keyword%")->latest()->paginate('6');
        return view('post.index', [
            'posts' => $posts,
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }
}
