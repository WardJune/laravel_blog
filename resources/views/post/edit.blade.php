@extends('layouts.app')

@section('title', 'Edit post')

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">Update : {{$post->title}}</div>
                    <div class="card-body">
                        <form action="/posts/{{$post->slug}}/edit" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            @include('post.partials.form-control', ['button' => 'Update'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection