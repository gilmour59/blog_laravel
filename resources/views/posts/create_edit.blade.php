@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            @isset($post)
                Edit Post
            @else
                Create Post
            @endisset
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li class="list-group text-danger">
                            {{ $error }}
                        </li>
                    @endforeach
                </div>
            @endif
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ isset($post) ? $post->name : ""}}">
                </div>
                <div class="form-group">
                    <input type="submit" value="Enter" class="btn btn-primary float-right">
                </div>
                    @isset($post)
                        @method('PUT')
                    @endisset
            </form>
        </div>
    </div>
@endsection
