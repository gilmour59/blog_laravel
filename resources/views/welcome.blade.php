@extends('layouts.post')

@section('title')

@if(isset($category))
    Category
@elseif(isset($tag))
    Tag
@else
    All Posts
@endif

@endsection

@section('header')
    <!-- Header -->
    <header class="header text-center text-white" style="background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);">
        <div class="container">

            <div class="row">
                <div class="col-md-8 mx-auto">
                    @if(isset($category))
                        <h1>{{ $category->name }}</h1>
                    @elseif(isset($tag))
                        <h1>{{ $tag->name }}</h1>
                    @else
                        <h1>Latest Posts</h1>
                    @endif
                </div>
            </div>

        </div>
    </header><!-- /.header -->
@endsection

@section('content')
    <!-- Main Content -->
    <main class="main-content">
        <div class="section bg-gray">
            <div class="container">
                <div class="row">

                    <div class="col-md-8 col-xl-9">
                        <div class="row gap-y">
                            @if ($posts->count() === 0)
                                @if (request()->query('search'))
                                    <span>No Results found for <strong> {{ request()->query('search') }}</strong></span>
                                @else
                                    <span>No posts yet! Sorry.</span>
                                @endif                                
                            @else
                                @foreach ($posts as $post)
                                    <div class="col-md-6">
                                        <div class="card border hover-shadow-6 mb-6 d-block">
                                            <a href="{{ route('posts.show', $post->id) }}"><img class="card-img-top" src="{{ asset('storage/' . $post->image) }}" alt="Card image cap"></a>
                                            <div class="p-6 text-center">
                                                <p><a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="#">{{ $post->category->name }}</a></p>
                                                <h5 class="mb-0"><a class="text-dark" href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        {{ $posts->appends(['search' => request()->query('search')])->links() }}
                    </div>
                    @include('includes.sidebar')
                </div>
            </div>
        </div>
    </main>
@endsection
