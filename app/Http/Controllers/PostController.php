<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\PostRequest;
use App\{Category, Post, Tag};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //! salah satu cara menggunakan middleware
    // public function __construct()
    // {
    //     $this->middleware('auth')->except([
    //         'index',
    //     ]);
    //! show all
    public function index()
    {
        $posts = Post::with('author')->latest()->paginate(6);
        return view('post.index', [
            'posts' => $posts,
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }

    //! show create form
    public function create()
    {
        return view('/post.create', [
            'post' => new Post,
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }

    //! store data to database
    public function store(PostRequest $validate)
    {
        $post = $validate->all();

        $thumbnail = $validate->file('thumbnail') ? $validate->file('thumbnail')->store('image/posts') : null;

        $post['slug'] = Str::slug($validate->title);
        $post['category_id'] = $validate->category;
        $post['thumbnail'] = $thumbnail;

        $posts = auth()->user()->posts()->create($post);
        $posts->tags()->attach(request('tags'));
        Alert::toast('Your Post has been added', 'success');

        return redirect()->to(route('posts.index'));
    }
    //! show selected item
    public function show(Post $post)
    {
        $posts = Post::with('author')->where('category_id', $post->category->id)->latest()->limit(4)->get();
        return view('post.detail', compact('post', 'posts'));
    }

    //! show edit form
    public function edit(Post $post)
    {
        return view('post.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }
    //! update item
    public function update(Post $post, PostRequest $validate)
    {
        $this->authorize('update', $post);

        if ($validate->file('thumbnail')) {
            Storage::delete($post->thumbnail);
            $thumbnail = $validate->file('thumbnail')->store('image/posts');
        } else {
            $thumbnail = $post->thumbnail;
        }

        $posts = $validate->all();
        $posts['category_id'] = request('category');
        $posts['thumbnail'] = $thumbnail;
        $post->update($posts);
        $post->tags()->sync(request('tags'));
        // session()->flash('success', 'Data berhasil diupdate');
        Alert::toast('Your post succesfully updated', 'success');
        return  redirect()->to(route('posts.index'));
    }
    //! destroy data
    public function destroy(Post $post)
    {
        if (auth()->user()->is($post->author)) {
            Storage::delete($post->thumbnail);
            $post->tags()->detach();
            $post->delete();
            return redirect()->to(route('posts.index'));
        } else {
            Alert::toast("it wasn't your post, you can't destroy it", 'error');
            return redirect()->to(route('posts.index'));
        }
    }
}
