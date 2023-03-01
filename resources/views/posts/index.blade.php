@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card mb-2 p-3">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        @if($post['cover_image'] !== 'noimage.jpeg')
                        <img src="/storage/cover_images/<?= $post['cover_image']?>" style="width: 100%" alt="">
                        @endif
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3 class="ml-2"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small class="ml-2">written on {{$post->created_at}} <b>{{$post->user->name}}</b></small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
        @else
            <p>No posts found</p>
    @endif
@endsection
