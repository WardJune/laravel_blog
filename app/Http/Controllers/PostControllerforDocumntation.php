<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //? show all
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('post.index', compact('posts'));
    }
    // menggarahkan ke form untuk penambahan data
    //? show create form
    public function create()
    {
        return view('/post.create');
    }
    //? store data to database
    public function store(Request $request, PostRequest $validate)
    {
        //* terdapat beberapa cara untuk memasukan data ke database

        //! menggunakan save
        // $post = new Post;
        // $post->title = $request->title;
        // $post->slug = Str::slug($request->title);
        // $post->body = $request->body;
        // $post->save()

        //? apabila menggunakan Post::create()
        //? maka harus menggunakan $fillable / $guarded pada model 

        //!  dapat menggunakan cara dibawah ketika tidak memodifikasi input 
        // Post::create($request->all())

        //! apa bila ingin memodifikasi isi dari request all
        // $post = $request->all();
        // $post['slug'] = \Str::slug($request->title);
        // Post::create($post);

        //! cara dengan langsung memasukan value ke Post::
        // Post::create([
        //     'title' => $request->title,
        //     'slug' => \Str::slug($request->title),
        //     'body' => $request->body,
        // ]);

        //* validasi juga terdapat bebrapa cara 

        //? cara basic 
        // $this->validate($request,[
        //      'title' => 'required|min:3',
        //      'body' => 'required'
        // ])
        // $post = $request->all();

        //? menggunakan $request langsung
        // $post = $request->validate([
        //     'title' => 'required|min:3',
        //     'body' => 'required'
        // ]);
        // $post['slug'] = \Str::slug($request->title);
        // 

        //? menggunakan function dari php request()
        // menghapus parameter (Request $request)
        // $post = request()->validate([
        //      'title' => 'required|min:3',
        //      'body' => 'required'
        // ])
        // $post['slug'] = \Str::slug(request('title'));

        $post = $validate->all();
        $post['slug'] = Str::slug($request->title);


        Post::create($post);

        session()->flash('success', 'Data berhasil dimasukan');
        return redirect()->to('/post');
    }
    //? show selected item
    public function show(Post $post)
    {
        return view('post.detail', compact('post'));
    }

    //? show edit form
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }
    //? update item
    public function update(Request $request, Post $post, PostRequest $validate)
    {
        // $posts = $request->validate([
        //     'title' => 'required|min:3',
        //     'body' => 'required'
        // ]);

        $posts = $validate->all();
        $post->update($posts);

        session()->flash('success', 'Data berhasil diupdate');
        return  redirect()->to('/post');
    }

    public function destroy(Post $post)
    {
        //
    }
}
