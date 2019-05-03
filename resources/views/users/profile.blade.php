@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Profile
        </div>
        <div class="card-body">
            @include('includes.validation_errors')
            <form action="{{ route('users.update-profile') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ? old('name') : (isset($user) ? $user->name : "") }}">
                </div>
                <div class="form-group">
                    <label for="name">Email:</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email') ? old('email') : (isset($user) ? $user->email : "") }}">
                </div>
                <div class="form-group">
                    <label for="about">About:</label>
                    <textarea name="about" id="about" cols="30" rows="5" class="form-control">{{ old('about') ? old('about') : (isset($user) ? $user->about : "") }}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Enter" class="btn btn-primary float-right">
                </div>
            </form>
        </div>
    </div>
@endsection
