@extends('layouts.app')

@section('title', 'New Post')

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">New Post</div>
                    <div class="card-body">
                        <form action="{{ route('posts.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('post.partials.form-control', ['button' => 'Add'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    