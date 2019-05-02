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
            @include('includes.validation_errors')
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ? old('title') : (isset($post) ? $post->title : "") }}">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ old('description') ? old('description') : (isset($post) ? $post->description : "") }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <input id="content" type="hidden" name="content" value="{{ old('content') ? old('content') : (isset($post) ? $post->content : "") }}">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At:</label>
                    <input type="text" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') ? old('published_at') : (isset($post) ? $post->published_at : "") }}">
                </div>
                @isset($post)
                    <div class="form-group">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width:100px;height:auto;">
                    </div>
                @endisset
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select name="category" id="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category') == $category->id) ? "selected" : (isset($post) ? ($category->id === $post->category_id ? "selected" : "") : "") }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($tags->count() > 0)
                    <div class="form-group">
                        <label for="tags">Select Tags:</label>
                        <select name="tags[]" id="tags" class="form-control tags-multiple" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    @if (old('tags') !== NULL)
                                        @if (in_array($tag->id, old('tags')))
                                            selected
                                        @endif                 
                                    @else
                                        @isset($post)
                                            @if ($post->hasTag($tag->id))
                                                selected
                                            @endif  
                                        @endisset
                                    @endif                                
                                >
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
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

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6/css/select2.min.css"/>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at',{
            enableTime : true
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tags-multiple').select2();
        });
    </script>
@endsection
