@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'App\Http\Controllers\PostsController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{form::label('title','Titile')}}
            {{form::text('title','',['class' => 'form-control','placeholder' => 'Title'])}}
        </div>
    <div class="form-group">
        {{form::label('body','Body')}}
        {{form::textarea('body','',['id' => 'article-ckeditor','class' => 'form-control','placeholder' => 'Body Text'])}}
    </div>
    <div class="form-group">
        {{form::file('cover_image')}}
    </div>
    {{form::submit('submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
