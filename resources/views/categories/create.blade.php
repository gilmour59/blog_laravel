@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Create Category
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
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="Enter" class="btn btn-primary float-right">
                </div>
            </form>
        </div>
    </div>
@endsection
