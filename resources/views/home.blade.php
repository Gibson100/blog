@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if(count($posts) > 0)
                        <a href="/posts/create" class="btn btn-primary">Create Post</a>
                        <h4 class="mt-2">Your Blog Posts</h4>


                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post->title}}</td>
                                        <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary float-right">Edit</a></td>
                                        <td>

                                            {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id],'method' => 'POST', 'class' => 'float-left']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <a href="/posts/create" class="btn btn-primary">Create Post</a>
                            <h4 class="mt-2">You have no posts</h4>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
