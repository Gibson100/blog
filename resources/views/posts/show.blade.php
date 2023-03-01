@extends('layouts.app')

@section('content')
    <a style="color:ghostwhite !important;" href="/posts" class="btn btn-default mt-2 mb-3 btn-lg text-dark bg-dark">
        <i class="fas fa-arrow-left"></i>
            Go back
    </a>
    <h1>{{$post->title}}</h1>
    @if($post['cover_image'] !== 'noimage.jpeg')
    <img src="/storage/cover_images/<?= $post['cover_image']?>" style="width: 100%" alt="">
    @endif
    <div>
{{--        {{ $post->body }}--}}
        {!! $post->body !!}
    </div>
    <hr>
    <small>written on {{$post->created_at}} by <b>{{$post->user->name}}</b></small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id === $post->user_id)
            <div style="display:flex">
                <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-primary"><b><i class="fas fa-edit"></i>&nbspEdit</b></a>

                {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id],'method' => 'POST', 'class' => 'pull-right']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger ml-1'])}}
                {!! Form::close() !!}
            </div>
        @endif
    @endif

@endsection
