@extends('layouts.app')

@section('title', $post->title)
@section('content')
   <div class="container py-3">
      <div class="row">
         <div class="col-md-8">
            <div class="border rounded p-3">
               @if ($post->thumbnail)
                  <img style='height: 18rem;object-fit:cover;object-position: center;' class="card-img-top rounded-0 mb-2" src="{{ asset($post->takeImage()) }}" >
               @endif
               <h2>{{$post->title}}</h2>
               <p class="text-muted"><a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a> &middot; {{$post->created_at->format('d F,Y')}} | 
               @foreach ($post->tags as $tag)
               <a class="badge badge-secondary" href="/tags/{{$tag->slug}}"># {{$tag->name}}</a>
               @endforeach
               </p>
               <div class="media my-3">
                  <img class="rounded-circle mr-3" src="{{$post->author->gravatar()}}">
                  <div class="media-body text-muted">
                     <div>
                        {{$post->author->name}}
                     </div>
                     {{'@' . $post->author->username}}
                  </div>
               </div>
               <p> {!! nl2br($post->body) !!}</p>
               
            @can('update', $post)
               <div>
                  <a href="{{ route('posts.edit', $post->slug)}}" class="btn btn-sm btn-warning rounded-0">Edit</a>
                  <button type="button" class="btn btn-sm btn-danger rounded-0" data-toggle="modal" data-target="#modaldelete">
                     Delete
                     </button>
               </div>
            @endcan
            </div>
               <div class="modal fade" id="modaldelete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modaldeleteLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modaldeleteLabel">Are you sure about this one ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        This action will delete this data
                        <div class="mt-1">
                           <div>Title : {{$post->title}}</div>
                           <div>Publised by : {{ $post->author->name}}</div>
                           
                           <div class="text-muted">Publised at : {{$post->created_at->format("d M,Y")}}</div>
                        </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-start">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('posts.delete', $post->slug)}}" method="post">
                           @csrf
                           @method('delete')
                           <button type="submit" class="btn btn-danger">Delete</button>
                           </div>
                        </form>
                     </div>
                  </div>
            </div>
         </div>
         <div class="col-md-4">
            @foreach ($posts as $pot)
               @if ($pot->id != $post->id)                   
               <div class="card mb-2">
                  <div class="card-body">
                     <small>
                        <a class="text-muted" href="{{ route('category.show', $pot->category->slug)}}">{{ $pot->category->name}}</a> |
                     </small>
                     @foreach ($pot->tags as $tag)
                        <a class="badge badge-secondary" href="{{route('tags.show', $tag->slug)}}"># {{$tag->name}}</a>
                     @endforeach
                     <h5>
                        <a href="{{ route('posts.show', $pot->slug) }}">{{ $pot->title}}</a>
                     </h5>
                     <div class="text-muted">
                        {{ Str::limit($pot->body, 125)}}
                     </div>
                     <div class="d-flex justify-content-between align-items-center my-3 ">
                        <div class="media align-items-center">
                           <img width="30" class="rounded-circle mr-3" src="{{$pot->author->gravatar()}}">
                           <div class="media-body text-muted">
                           <div>
                              {{$pot->author->name}}
                           </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endif
            @endforeach
         </div>
      </div>
      
   </div>
@endsection
