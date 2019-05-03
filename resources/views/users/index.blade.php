@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">
            @if ($users->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>About</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td width="20%">
                                    {{ $user->name }}
                                </td>
                                <td width="30%">
                                    {{ $user->email }}
                                </td>
                                <td width="20%">
                                    {{ $user->about }}
                                </td>
                                <td width="10%">
                                    @if (!$user->isAdmin())
                                        <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h5 class="text-center">No Users Yet!</h5>
            @endif
        </div>
    </div>
@endsection
