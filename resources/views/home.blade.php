@extends('layouts.app')

@section('content')
    <div class="jumbotron bg-light text-center">
        <div class="container">
            <h3>Find Something New Here</h3>
            <p  class="lead">It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-dark rounded-0" href="{{ route('posts.index')}}" role="button">Findout Now</a>
        </div>
    </div>

    <section class="container">
        <div class="text-center mb-5">
            <h3>Latest Post</h3>
            <h5 class="text-muted">
                What's new on ColdTrash?
            </h5>
        </div>

        <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-4 mb-5">
                <div class="card rounded-lg shadow border-0">
                    <a href="{{ route('posts.show', $post->slug)}}">
                        <img style='height: 10rem;object-fit:cover;object-position: center;' src="{{ $post->takeImage()}}"  class="card-img-top">
                    </a>
                    <div class="card-body">
                        <a class="text-dark" href="{{ route('posts.show', $post->slug)}}">
                            {{$post->title}}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    </section>
    <section>
        <div class="jumbotron jumbotron-fluid bg-light">
            <div class="container">
                <h1 class="display-4">Fluid jumbotron</h1>
                <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="text-center mb-5">
            <h3>Post by Category</h3>
            <p class="text-muted">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
        </div>

        <div class="row">
            @foreach ($categories as $category)

            <div class="col-md-4 mb-4">
                <div class="list-group list-group-flush">
                    <li class="h5 list-group-item bg-light rounded">{{$category->name}}</li>
                    @foreach ($category->select($category->id) as $cat)
                    <a href="{{ route('posts.show', $cat->slug)}}" class="list-group-item list-group-item-action border-0">
                        <div class="d-flex justify-content-between">
                            <p>{{$cat->title}}</p>
                            <img src="{{$cat->takeImage()}}" class="rounded-lg" style='height:4rem;width:4rem;object-fit:cover;object-position: center;'>
                        </div>
                    </a>
                    @endforeach
                    <a class="ml-4 text-secondary" href="{{route('category.show', $category->slug)}}">see all &rarr;</a>
                </div>
            </div>
            @endforeach
        </div>

    </section>
@endsection
