@extends('layouts.app')

@section('title', 'Posts')
@section('content')
<div class="jumbotron rounded-0 bg-secondary text-center text-light">
    @isset($categor)
    <h3>Category : {{$categor->name}}</h3>
    <p class="lead mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, odio.</p>
    @endisset
    
    @isset($tag)
    <h3>Tag : {{$tag->name}}</h3>
    <p class="lead mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, odio.</p>
    @endisset
    
    @if(!isset($categor) && !isset($tag))
    <h3>All Post</h3>
    <p class="lead mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, odio.</p>
    @endif
    {{-- <div>
        @if (Auth::check())
        <a class="btn btn-primary" href="{{ route('posts.create')}}">Add New</a>
        @else
        <a class="btn btn-primary" href="{{ route('login')}}">Login to create new post</a>
        @endif
    </div> --}}
</div>
<div class="container index">
    <div class="row  py-4  rounded-lg">
        <div class="col-md-8">
            @forelse ($posts as $post)     
                <div class="col">
                    <div class="card  mb-3 shadow">
                        @if ($post->thumbnail)
                        <a href="{{ route('posts.show', $post->slug)}}">
                        <img style='height: 18rem;object-fit:cover;object-position: center;' class="card-img-top rounded-0" src="{{ asset($post->takeImage()) }}" >
                        </a>
                        @endif
                        <div class="card-body">
                            <small class="mr-2">
                                <a class="text-muted" href="{{ route('category.show', $post->category->slug)}}">{{ $post->category->name}}</a>
                            </small>
                            |
                            @foreach ($post->tags as $tag)
                                    <a class="ml-2 badge badge-secondary" href="{{route('tags.show', $tag->slug)}}"># {{$tag->name}}</a>
                            @endforeach
                            <h5>
                                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title}}</a>
                            </h5>
                            <div class="text-muted">
                                {{ Str::limit($post->body, 125)}}
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-3 ">
                                <div class="media align-items-center">
                                    <img width="30" class="rounded-circle mr-3" src="{{$post->author->gravatar()}}">
                                    <div class="media-body text-muted">
                                    <div>
                                        {{$post->author->name}}
                                    </div>
                                    </div>
                                </div>
                                <small>Publised on {{ $post->created_at->diffForHumans()}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-secondary">There are no post</div>
            @endforelse
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Category</h4>
                </div>
                <div class="card-body list-group-flush">
                    @foreach ($categories as $category)
                        <a href="{{route('category.show', $category->slug)}}" class="list-group-item list-group-item-action">{{$category->name}}</a>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Tags</h4>
                </div>
                <div class="card-body">
                    @foreach ($tags as $tag)
                        <a href="{{route('tags.show',$tag->slug)}}" class="badge badge-primary">{{$tag->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        {{ $posts->links() }}
    </div>
</div>
@endsection



